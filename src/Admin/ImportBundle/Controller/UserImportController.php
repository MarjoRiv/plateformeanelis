<?php

namespace Admin\ImportBundle\Controller;

use Admin\ImportBundle\Entity\UserImport;
use Admin\ImportBundle\Entity\UserImportAction;
use Admin\ImportBundle\Entity\UserImportLine;
use Admin\ImportBundle\Entity\UserImportLineState;
use Admin\ImportBundle\Entity\UserImportState;
use Admin\ImportBundle\Form\UserImportFileType;
use Admin\ImportBundle\Form\UserImportLinesEditType;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UserImportController extends CRUDController
{
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
        $request = $this->getRequest();

        //TODO : Exception
        $import = $em->getRepository('AdminImportBundle:UserImport')->find($id);
        $lines = $import->getLines();

        $form = $this->get('form.factory')->createNamedBuilder('form',
            UserImportLinesEditType::class, array('lines' => $lines), array('state' => $import->getState()))->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //On verra ça plus tard
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

}
