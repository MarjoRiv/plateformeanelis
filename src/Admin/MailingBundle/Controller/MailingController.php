<?php

namespace Admin\MailingBundle\Controller;

use \Mailjet\Resources;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MailingController extends Controller
{	
	/**
     * Récupère le Mailjet_ID d'une liste de diffusion de la BD.
     *
     * @param int $id  L'ID d'une liste dans la BD
     *
     * @return string $list_id L'ID mailjet d'une liste de diffusion. 0 si elle n'est pas trouvée.
	 *
     */
	private function getDBListID($id){
		
		//Récupération de la listID stockée dans la BD
		$em = $this->getDoctrine()->getManager();
		$newsletter = $em->getRepository('AdminMailingBundle:Newsletter')->find($id);
		$list_id = $newsletter->getMailjetId();
		
		//Retourne l'ID de la liste
		return $list_id;	
	}
	
	/**
     * Récupère les coordonnées des utilisateurs d'une liste de la BD.
     *
     * @param int $id  L'ID d'une liste dans la BD
     *
     * @return array $users La liste des utilisateurs (noms + email)
	 *
     */
	private function getDBUsers($id){
		
		//La valeur de retour
		$users=array();
		
		//Récupération de liste des utilisateurs de la BD
		$em = $this->getDoctrine()->getManager();
		$newsletter = $em->getRepository('AdminMailingBundle:Newsletter')->find($id);
		$all_users = $newsletter->getUsers();
		
		//Création du tableau avec tous les noms et les adresses mail
		foreach ($all_users->toArray() as $user){
			
			//Ne prendre que les utilisateurs avec des adresses e-mail valides
			if ($user->getIsEmailValid()){
				$new_user = array (
					'Email'  => $user->getEmail(),
					'Name' => $user->getName()
				);
				array_push($users, $new_user);
			}
		}
		
		//Retourner la liste des utilisateurs
		return $users;
	}
	
	/**
     * Récupère tous les utilisateurs d'une liste de Mailjet
     *
     * @param string $list_id  L'ID mailjet d'une liste de diffusion
     *
     * @return array|string $result La liste des utilisateurs. 0 S'il y'a eu une erreur lors du contact avec Mailjet. 1 si la liste n'a pas été trouvée.
	 *
     */
	private function mailjetGetAllUsers($list_id){
		

		//Récupération de tous les contacts de la liste Mailjet
		$mj = new \Mailjet\Client(getenv('MJ_PUBLIC_KEY'), getenv('MJ_PRIVATE_KEY'));
		$result = '0';
		
		//On récupère les utilisateurs de la liste Mailjet dont l'ID est celui passé en paramètre
		$response = $mj->get(Resources::$Contactslist, ['id' => $list_id]);
		if (!$response->success()){
			
			//Si la liste n'existe pas, on renvoie 1
			if(array_key_exists("StatusCode", $response->getData()) && $response->getData()["StatusCode"]== 404){
				$result = '1';
			}
		}
		
		//Sinon on récupère la liste des utilisateurs inscrits à la liste Mailjet en question
		else $result = $mj->get(Resources::$Contact, ['contactslist' => $list_id]);
		
		//On retourne la liste des contacts, 0 si Mailjet n'a pas pu être contacté, 1 si la liste n'existe pas
		return $result;   
	}
	
	/**
     * Exporte une liste d'utilisateurs vers une liste Mailjet
     *
     * @param string $list_id  L'ID mailjet d'une liste de diffusion
	 * @param array $users La liste des utilisateurs à exporter
     *
     * @return int 0
	 *
     */
	private function mailjetExportList($list_id, $users){
	
		//Ajout des contacts à la liste
		$mj = new \Mailjet\Client(getenv('MJ_PUBLIC_KEY'), getenv('MJ_PRIVATE_KEY'));
		$body = [
			'ContactsLists' => [
				[
					'ListID' => $list_id,
					'action' => "addforce"
				]
			],
			'Contacts' => $users
		];
	
		//On effectue les modifications sur la liste Mailjet et on retourne un message indiquant un succès
		$mj->post(Resources::$ContactManagemanycontacts, ['body' => $body]);

		return 0;
	}
	
	/**
     * Supprime les utilisateurs une liste Mailjet
     *
     * @param string $list_id  L'ID mailjet d'une liste de diffusion-
	 * @param array $users La liste des utilisateurs à supprimer
     *
     * @return int 0
	 *
     */
	private function mailjetDeleteList($list_id, $users){

		//Ajout des contacts à la liste
		$mj = new \Mailjet\Client(getenv('MJ_PUBLIC_KEY'), getenv('MJ_PRIVATE_KEY'));
		$body = [
			'ContactsLists' => [
				[
					'ListID' => $list_id,
					'action' => "remove"
				]
			],
			'Contacts' => $users
		];
	
		//On effectue les modifications sur la liste Mailjet et on retourne un message d'erreur
		$mj->post(Resources::$ContactManagemanycontacts, ['body' => $body]);
		return 0;
	}
	
	/**
     * Ajoute une nouvelle liste sur Mailjet
     *
     * @param int $id  L'ID d'une liste dans la BD
     *
     * @return string 
	 *
     */
	private function mailjetAddList($id){
		
		//Récupération du nom de la liste à ajouter
		$em = $this->getDoctrine()->getManager();
		$newsletter = $em->getRepository('AdminMailingBundle:Newsletter')->find($id);
		$name = $newsletter->getNewsletter();
		
		//Ajout de la liste dans Mailjet
		$mj = new \Mailjet\Client(getenv('MJ_PUBLIC_KEY'), getenv('MJ_PRIVATE_KEY'));
		$mj->post(Resources::$Contactslist, ['body' => ['name' => $name]]);
		
		//Mise en place de la List ID Mailjet dans la BD
		$response = $mj->get(Resources::$Contactslist, ['filters' => ['name' => $name]]);
		$list_id = $response->getData()[0]['ID'];
		$newsletter->setMailjetId((string)$list_id);
		$em->flush();
	
		return $list_id;
	}
	
	/**
     * Action relative au clic sur le bouton "Maijet Export"
     *
     * @param int $id  L'ID de la ligne cliquée
	 *
	 * @return RedirectResponse $url L'URL permettant de revenir sur la page de la liste des newsletters
     */
    public function mailjetexportAction($id)
    {
		
		//Récupération de l'élément sélectionné
        $object = $this->admin->getSubject();
        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id: %s', $id));
        }
		
		//Ajoute tous les utilisateurs à la liste en question
		$list_id = self::getDBListID($id);
		
		//Si la liste a un ID Mailjet assigné
		if ($list_id == '0'){
			$list_id = self::mailjetAddList($id);
			$this->addFlash('sonata_flash_success', 'Nouvelle liste crée avec ID = '.$list_id);
		}
			
		//Récupération de tous les utilisateurs de la liste Mailjet concernée
		$users = self::mailjetGetAllUsers($list_id);
		if ($users != '0'){
			if ($users != '1'){
				self::mailjetDeleteList($list_id, $users);
			
				// Export de la liste des contacts de la BD vers Mailjet
				$users = self::getDBUsers($id);
				self::mailjetExportList($list_id, $users);
					
					//Message indiquant un succès
					$this->addFlash('sonata_flash_success', 'Export réussi');
			}
			
			//Si la liste à supprimer n'a pas été trouvée sur Mailjet, afficher un message d'erreur
			else{
				$this->addFlash('sonata_flash_error', 'Aucune liste mailjet trouvée avec ID = '.$list_id);
			}
		}
		
		//Si on n'a pas réussi à accéder à Mailjet, afficher un message d'erreur
		else{
			$this->addFlash('sonata_flash_error', 'Impossible de joindre Mailjet');
		}
		
		//Revenir sur la page avec la liste des newsletters
        return new RedirectResponse($this->admin->generateUrl('list'));

        // if you have a filtered list and want to keep your filters after the redirect
        // return new RedirectResponse($this->admin->generateUrl('list', ['filter' => $this->admin->getFilterParameters()]));
    }


	/**
     * Action relative à l'ajout d'un utilisateur"
     *
     * @param int $id  L'ID de la ligne cliquée
	 *
	 * @return RedirectResponse $url L'URL permettant de revenir sur la page de la liste des newsletters
     */
    public function addUserListAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
        $listeUser = self::getalluser($em);
        $newsletter = self::getNewsletter($em,$id);
	    $newsletter->setUsers($listeUser);
	    if(empty($newsletter->getUsers())){
	    	$this->addFlash('sonata_flash_error', 'Erreur d\'ajout d\'utilisateurs dans newsletter');
	    }
	    $em->flush();
        $this->addFlash('sonata_flash_success', 'Users Ajouté');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }
     /**
     * Ajout tout les utilisateurs de la promo a la newsletters
     * @param $id, $promotion
     */
    public function addUserPromoAction($id,$promotion)
    {
		$em = $this->getDoctrine()->getManager();
        $listeUser = self::getalluser($em);
        $newsletter = self::getNewsletter($em,$id);
        foreach ($listeUser as $user) {
        	if ($user->getPromotion() ==(string)$promotion) {
        		$newsletter->setUsers($user);
        	}
        }
	    if(empty($newsletter->getUsers())){
	    	$this->addFlash('sonata_flash_error', 'Erreur d\'ajout de la promotion');
	    }
	    $em->flush();
        $this->addFlash('sonata_flash_success', 'Users Ajouté');

        return new RedirectResponse($this->admin->generateUrl('list'));
    }

    private function getalluser($em){
		
        $listeUser = $em->getRepository("AdminUserBundle:User")->findAll();
        if (!$listeUser) {
        	$this->addFlash('sonata_flash_error', 'Erreur sur la récupération des utilisateur');
	        throw $this->createNotFoundException(
	            'Aucun user trouvé'
	        );
    	}
    	return $listeUser;
    }
    /**
     * @param $id
     */
    private function getNewsletter($em,$id){
        $newsletter = $em->getRepository('AdminMailingBundle:Newsletter')->find($id);
        if (!$newsletter) {
        	$this->addFlash('sonata_flash_error', 'Erreur sur la newsletter');
	        throw $this->createNotFoundException(
	            'Aucun newsletter trouvé avec l\'id :  '.$id
	        );
    	}
    	return $newsletter;
    }
}
