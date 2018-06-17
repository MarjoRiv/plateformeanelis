<?php

namespace Admin\ImportBundle\Controller;

use Admin\ImportBundle\Entity\UserImport;
use Admin\ImportBundle\Entity\UserImportAction;
use Admin\ImportBundle\Entity\UserImportLine;
use Admin\ImportBundle\Entity\UserImportLineError;
use Admin\ImportBundle\Entity\UserImportLineState;
use Admin\ImportBundle\Entity\UserImportState;
use Admin\ImportBundle\Form\UserImportFileType;
use Admin\ImportBundle\Form\UserImportLinesEditType;
use Admin\UserBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\PersistentCollection;
use FOS\UserBundle\Model\UserManager;
use function GuzzleHttp\default_ca_bundle;
use function GuzzleHttp\Psr7\str;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserImportController extends CRUDController
{

    private $RFC_5322_Standard_Mail_REGEXP = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
    private $ANELIS_Login_REGEXP = '/\S+\.\S+\.[0-9]{4}\Z/m';

    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();
        $csvSerializer = $this->getSerializer();
        $request = $this->getRequest();

        $errors = [];

        $fileForm = $this->get('form.factory')->createNamedBuilder('fileForm',
            UserImportFileType::class, null, [])->getForm();

        $fileForm->handleRequest($request);
        $fileFormView = $fileForm->createView();
        if($fileForm->isSubmitted() && $fileForm->isValid()) {
            /**
             * @var $datas UploadedFile
             */
            $datas = $this->decodeFile($fileForm['file']->getData(), $csvSerializer);
            $error_headers = $this->checkHeader($datas);
            dump($error_headers);
            dump($datas);
            if(count($error_headers) == 0)
            {
                $errors['header'] = false;
                $import = new UserImport();
                $import->setCreatedDate(new \DateTime());
                $import->setState(UserImportState::TODO);
                $import->setLastRunDate(null);

                if(isset($datas[0]))
                {
                    foreach ($datas as $data) //TODO :  Fonction
                    {
                        $line = new UserImportLine();
                        $line->setState(UserImportLineState::TODO);
                        $line->setAction(UserImportAction::getIntValueFromString($data['action']));
                        $line->setAdresse($data['adresse']);
                        $line->setFiliere($data['filiere']);
                        $line->setImport($import);
                        $line->setLogin($data['login']);
                        $line->setMail($data['mail']);
                        $line->setPromo($data['promo']);
                        $line->setTelephone($data['telephone']);
                        $line->setNom($data['nom']);
                        $line->setPrenom($data['prenom']);

                        $import->addLine($line);

                        $em->persist($line);
                        $em->persist($import);
                        $em->flush();
                    }
                }
            }
            else
            {
                $errors['header'] = true;
                $errors['header_errors'] = $error_headers;
            }
        }

        return $this->render('AdminImportBundle:Default:create.html.twig', array(
            "form" => $fileFormView,
            "errors" => $errors
        ));
    }

    public function listAction()
    {
        return parent::listAction();
    }

    public function editAction($id = null)
    {

        $em = $this->getDoctrine()->getManager();
        $um = $this->get('fos_user.user_manager');
        $request = $this->getRequest();

        //TODO : Exception
        $import = $em->getRepository('AdminImportBundle:UserImport')->find($id);
        $lines = $import->getLines();

        //FIXME : Mieux gérer ça
        if($import->getState() == UserImportState::TERMINE)
            return $this->listAction();

        $form = $this->get('form.factory')->createNamedBuilder('form',
            UserImportLinesEditType::class, array('lines' => $lines), ['state' => $import->getState()])->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            if($form->get('check')->isClicked())
            {
                $importError = $this->checkLines($em, $form->getData()['lines']);

                $import->setState($importError ? UserImportState::KO : UserImportState::OK);
                $import->setLastRunDate(new \DateTime());

                $em->persist($import);
                $em->flush();

                //Nettoyage des lignes d'erreur
                $em->getRepository('AdminImportBundle:UserImportLineError')->clean();

                return $this->listAction();
            }
            else
            {
                $lines = $this->getOKKOLines($form->getData()['lines']);
                dump($lines);
                $this->importLines($um,$lines['ok']);
                //TODO : Ajouter l'import CSV.
//                if(!empty($lines['ko']))
//                {
//                    $csv = $this->getSerializer()->serialize($lines['ko'],'csv');
//                }

                $import->setState(UserImportState::TERMINE);
                $import->setLastRunDate(new \DateTime());

                $em->persist($import);
                $em->flush();

                return $this->listAction();
            }
        }

        return  $this->render('AdminImportBundle:Default:edit.html.twig', array(
            "form" => $form->createView()
        ));


    }

    //TODO : A déplacer dans une classe UserImportBusiness
    private function getSerializer()
    {
        $encoders = array(new CsvEncoder());
        $normalizers = array(new ObjectNormalizer());

        return new Serializer($normalizers, $encoders);
    }

    /**
     * @param UploadedFile $file
     * @param Serializer $serializer
     * @return array
     */
    private function decodeFile(UploadedFile $file, Serializer $serializer)
    {
        return $serializer->decode(file_get_contents($file->getPathname()), 'csv');
    }

    private function checkHeader(array $datas)
    {
        $headers = ['action', 'login', 'mail', 'prenom', 'nom', 'promo', 'filiere', 'adresse', 'telephone'];
        $ko_headers = array();

        if(isset($datas[0]))        //CSV Multi-lignes
        {
            foreach ($datas as $data)
            {
                foreach ($headers as $header)
                {
                    if(!isset($data[$header]) && !in_array($header, $ko_headers))
                    {
                        $ko_headers[] = $header;
                    }
                }
            }
        }
        else                        //CSV 1 Ligne
        {
            foreach ($headers as $header)
            {
                if(!isset($datas[$header]))
                {
                    $ko_headers[] = $header;
                }
            }
        }

        return $ko_headers;
    }


    private function checkLines(ObjectManager $em, $lines)
    {
        $importError = false;
        foreach($lines as $line)
        {
            switch($line->getAction())
            {
                case UserImportAction::CREATE:
                    $error = $this->checkLineCreate($em,$line);
                    break;
                case UserImportAction::UPDATE:
                    $error = $this->checkLineUpdate($em,$line);
                    break;
                case UserImportAction::DELETE:
                    $error = $this->checkLineDelete($em,$line);
                    break;
                default:
                    break;
            }
            $importError = $importError || $error;
        }

        return $importError;
    }

    private function checkLineCreate(ObjectManager $em, UserImportLine $line)
    {
        $errors = $this->basicLineCheck($line);

        //TODO : Un peu d'optimisation ici à faire

        if(!$this->checkPresence($line->getLogin()) && !$errors->isNomNotFound() && !$errors->isPrenomNotFound())
        {
            $line->setLogin($this->generateLogin($line->getPrenom(), $line->getNom(), $line->getPromo()));
        }
        $errors->setLoginKo(!$this->checkLogin($line->getLogin()));

        if($this->checkPresence($line->getLogin()))
        {
            $user = $em->getRepository('AdminUserBundle:User')->findOneBy(['username' => $line->getLogin()]);
            $errors->setLoginAlreadyExists($user != null);
        }
        $lineError = $errors->isLineError();

        $line->setState($lineError ? UserImportLineState::ERROR : UserImportLineState::PRET);
        $line->setErrors($errors);

        $em->persist($line);
        $em->flush();

        return $lineError;
    }

    private function checkLineUpdate(ObjectManager $em, UserImportLine $line)
    {
        $user = $em->getRepository('AdminUserBundle:User')->findOneBy(['username' => $line->getLogin()]);
        $errors = $this->basicLineCheck($line, true);

        $errors->setLoginNotFound($user == null);


        $lineError = $errors->isLineError();

        $line->setState($lineError ? UserImportLineState::ERROR : UserImportLineState::PRET);
        $line->setErrors($errors);

        $em->persist($line);
        $em->flush();

        return $lineError;
    }

    private function checkLineDelete(ObjectManager $em, UserImportLine $line)
    {
        $user = $em->getRepository('AdminUserBundle:User')->findOneBy(['username' => $line->getLogin()]);
        $errors = new UserImportLineError();

        $errors->setLoginNotFound($user == null);

        $lineError = $errors->isLineError();

        $line->setState($lineError ? UserImportLineState::ERROR : UserImportLineState::PRET);
        $line->setErrors($errors);

        $em->persist($line);
        $em->flush();

        return $lineError;
    }

    /**
     * @param $line
     * @return UserImportLineError
     *
     * Calcul les erreurs de base pour n'importe quel type de check.
     */
    private function basicLineCheck(UserImportLine $line, $update = false) : UserImportLineError
    {
        $errors = new UserImportLineError();

        $errors->setNomNotFound(!$this->checkPresence($line->getNom()));

        $errors->setPrenomNotFound(!$this->checkPresence($line->getPrenom()));

        $errors->setEmailKo(!$this->checkMail($line->getMail()));

        return $errors;
    }

    /**
     * @param $line_object
     * @return bool
     * Permet de vérifier l'existance d'un champ obligatoire. Dans le cas d'un update, les champs peuvent être vides (ne pas mettre à jour).
     */
    private function checkPresence($line_object, $update = false)
    {
        return $line_object != null && (!$update? strcmp($line_object,"") != 0 : true) && strcmp($line_object, "-");
    }

    private function checkMail(string $email)
    {
        return preg_match($this->RFC_5322_Standard_Mail_REGEXP, $email);
    }

    private function checkLogin(string $login)
    {
        return preg_match($this->ANELIS_Login_REGEXP, $login);
    }

    private function generateLogin(string $prenom, string $nom, int $promo)
    {
        return strtolower($prenom).".".strtolower($nom).".".$promo;
    }

    private function getOKKOLines($lines)
    {
        $ok_lines = array();
        $ko_lines = array();
        foreach ($lines as $line)
        {
            if($line->getState() == UserImportLineState::PRET)
            {
                $ok_lines[] = $line;
            }
            else
            {
                $ko_lines[] = $line;
            }
        }

        return [
            'ok' => $ok_lines,
            'ko' => $ko_lines
        ];
    }

    private function importLines(UserManager $um, $lines)
    {
        foreach($lines as $line)
        {
            dump($line);
            switch($line->getAction())
            {
                case UserImportAction::CREATE:
                    $this->importLineCreate($um,$line);
                    break;
                case UserImportAction::UPDATE:
                    $this->importLineUpdate($um,$line);
                    break;
                case UserImportAction::DELETE:
                    $this->importLineDelete($um,$line);
                    break;
                default:
                    break;
            }
        }
    }

    private function importLineCreate(UserManager $um,UserImportLine $line)
    {
        $user = $um->createUser();
        $user = $this->updateUser($user, $line);
        $user->setUsername($line->getLogin());
        $user->setPlainPassword("hello");
        $um->updateUser($user);
    }

    private function importLineUpdate(UserManager $um, UserImportLine $line)
    {
        $user = $um->findUserByUsername($line->getLogin());
        $user = $this->updateUser($user, $line);
        $um->updateUser($user);
    }

    private function importLineDelete(UserManager $um, UserImportLine $line)
    {
        $user = $um->findUserByUsername($line->getLogin());
        $um->deleteUser($user);
    }

    private function updateUser(User $user, UserImportLine $line)
    {
        if(strcmp($line->getNom(),"") != 0)
            $user->setName($line->getNom());

        if(strcmp($line->getPrenom(),"") != 0)
            $user->setSurname($line->getPrenom());

        if(strcmp($line->getPromo(),"") != 0)
            $user->setPromotion(intval($line->getPromo()));

        if(strcmp($line->getMail(),"") != 0)
            $user->setEmail($line->getMail());

        if(strcmp($line->getFiliere(),"-"))
            $user->setFiliere("");
        else if(strcmp($line->getFiliere(),"") != 0)
            $user->setFiliere($line->getFiliere());

        if(strcmp($line->getTelephone(),"-"))
            $user->setTelephone("");
        else if(strcmp($line->getTelephone(),"") != 0)
            $user->setTelephone($line->getTelephone());

        if(strcmp($line->getAdresse(),"-"))
            $user->setAddress("");
        else if(strcmp($line->getAdresse(),"") != 0)
            $user->setAddress($line->getAdresse());

        return $user;
    }
}
