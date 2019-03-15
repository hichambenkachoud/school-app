<?php
/**
 * Created by PhpStorm.
 * User: hicham benkachoud
 * Date: 06/03/2019
 * Time: 15:44
 */

namespace ManagementBundle\Controller;


use ManagementBundle\Entity\AcademicYear;
use ManagementBundle\Entity\Filiere;
use ManagementBundle\Entity\Level;
use ManagementBundle\Entity\Module;
use ManagementBundle\Entity\Referentiel;
use ManagementBundle\Form\AcademicYearType;
use ManagementBundle\Form\FiliereType;
use ManagementBundle\Form\LevelType;
use ManagementBundle\Form\ModuleType;
use ManagementBundle\Form\ReferentielType;
use ManagementBundle\Form\ModuleImportType;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ManagementController extends Controller
{
    /* start Academic year */

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/academicYears", name="list_academic_year")
     */
    public function getAllAcademicYears()
    {
        $academicYears = $this->getDoctrine()->getRepository('ManagementBundle:AcademicYear')->findAll();

        return $this->render('ManagementBundle:Academic:list.html.twig',
            array(
                'academicYears' => $academicYears
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/academicYear/add", name="add_academic_year")
     */
    public function addAcademicYear(Request $request){

        $year = new AcademicYear();
        $form = $this->createForm(AcademicYearType::class, $year);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($year);
            $em->flush();

            return $this->redirectToRoute('list_academic_year');
        }

        return $this->render('ManagementBundle:Academic:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request | $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/academicYear/edit/{id}", name="update_academic_year", requirements={"id"="\d+"})
     */
    public function updateAcademicYear(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $year = $em->getRepository('ManagementBundle:AcademicYear')->find($id);
        $form = $this->createForm(AcademicYearType::class, $year);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('show_academic_year',
                array(
                    'id' => $id
                ));
        }

        return $this->render('ManagementBundle:Academic:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/academicYear/{id}", name="show_academic_year", requirements={"id"="\d+"})
     */
    public function showAcademicYear($id)
    {
        $year = $this->getDoctrine()->getRepository('ManagementBundle:AcademicYear')->find($id);

        return $this->render('ManagementBundle:Academic:show.html.twig',
            array(
                'academicYear' => $year
            )
        );
    }

    /* end Academic year */

    /* start level */

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/levels", name="list_level")
     */
    public function getAllLevelAction()
    {
        $levels = $this->getDoctrine()->getRepository('ManagementBundle:Level')->findAll();

        return $this->render('ManagementBundle:Level:list.html.twig',

            array(
                'levels' => $levels
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/level/add", name="add_level")
     */
    public function addLevelAction(Request $request)
    {
        $level = new Level();
        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($level);
            $em->flush();

            return $this->redirectToRoute('list_level');
        }

        return $this->render('ManagementBundle:Level:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/level/edit/{id}", name="update_level", requirements={"id"="\d+"})
     */
    public function updateLevelAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $level = $em->getRepository('ManagementBundle:Level')->find($id);
        $form = $this->createForm(LevelType::class, $level);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('show_level',
                array(
                    'id' => $id
                )
            );
        }

        return $this->render('ManagementBundle:Level:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/level/{id}", name="show_level", requirements={"id"="\d+"})
     */
    public function showLevelAction($id)
    {
        $level = $this->getDoctrine()->getRepository('ManagementBundle:Level')->find($id);

        return $this->render('ManagementBundle:Level:show.html.twig',
            array(
                'level' => $level
            )
        );
    }

    /* end level */

    /* start filiere */

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/filieres", name="list_filiere")
     */
    public function getAllFiliereAction()
    {
        $filieres = $this->getDoctrine()->getRepository('ManagementBundle:Filiere')->findAll();

        return $this->render('ManagementBundle:Filiere:list.html.twig',

            array(
                'filieres' => $filieres
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/filiere/add", name="add_filiere")
     */
    public function addFiliereAction(Request $request)
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($filiere);
            $em->flush();

            return $this->redirectToRoute('list_filiere');
        }

        return $this->render('ManagementBundle:Filiere:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/filiere/edit/{id}", name="update_filiere", requirements={"id"="\d+"})
     */
    public function updateFiliereAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $filiere = $em->getRepository('ManagementBundle:Filiere')->find($id);
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('show_filiere',
                array(
                    'id' => $id
                )
            );
        }

        return $this->render('ManagementBundle:Filiere:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/filiere/{id}", name="show_filiere", requirements={"id"="\d+"})
     */
    public function showFiliereAction($id)
    {
        $filiere = $this->getDoctrine()->getRepository('ManagementBundle:Filiere')->find($id);

        return $this->render('ManagementBundle:Filiere:show.html.twig',
            array(
                'filiere' => $filiere
            )
        );
    }
    /* end filiere*/
    /* start referentiel*/

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/referentiels", name="list_referentiel")
     */
    public function getAllReferentielAction()
    {
        $referentiels = $this->getDoctrine()->getRepository('ManagementBundle:Referentiel')->findAll();

        return $this->render('ManagementBundle:Referentiel:list.html.twig',
            array(
                'referentiels' => $referentiels
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/referentiel/add", name="add_referentiel")
     */
    public function addReferentielAction(Request $request)
    {
        $referentiel = new Referentiel();
        $form = $this->createForm(ReferentielType::class, $referentiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $referentiel->setCreationDate(new \DateTime());
            $em->persist($referentiel);
            $em->flush();

            return $this->redirectToRoute('list_referentiel');
        }

        return $this->render('ManagementBundle:Referentiel:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/referentiel/edit/{id}", name="update_referentiel", requirements={"id"="\d+"})
     */
    public function updateReferentielAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $referentiel= $em->getRepository('ManagementBundle:Referentiel')->find($id);
        $form = $this->createForm(ReferentielType::class, $referentiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();

            return $this->redirectToRoute('show_referentiel',
                array(
                    'id' => $id
                )
            );
        }

        return $this->render('ManagementBundle:Referentiel:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/referentiel/{id}", name="show_referentiel", requirements={"id"="\d+"})
     */
    public function showReferentielAction($id)
    {
        $referentiel = $this->getDoctrine()->getRepository('ManagementBundle:Referentiel')->find($id);

        return $this->render('ManagementBundle:Referentiel:show.html.twig',
            array(
                'referentiel' => $referentiel
            )
        );
    }

    /* start module*/

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/modules", name="list_module")
     */
    public function getAllModulesAction(Request $request)
    {
        $modules = $this->getDoctrine()->getRepository('ManagementBundle:Module')->findAll();
        $em = $this->getDoctrine()->getManager();
        $module = new Module();
        $form = $this->createForm(ModuleImportType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $module->getFile();
            $cvName = md5(uniqid()) . '.csv';
            $filePath = $module->getUploadRootDir();
            $file->move($filePath, $cvName);

            $mods = $this->importData($filePath, $cvName);


            foreach ($mods as $mod) {
                // On crée un objet utilisateur

                $module = new Module();
                // Encode le mot de passe


                $module->setTitle($mod["title"]);
                $module->setCode($mod["code"]);
                $module->setHours($mod["hours"]);
                $module->setCoefficient($mod["coefficient"]);

                // Enregistrement de l'objet en vu de son écriture dans la base de données
                $em->persist($module);

            }

            $em->flush();

            return $this->redirectToRoute('list_module');

        }

        return $this->render('ManagementBundle:Module:list.html.twig',
            array(
                'modules' => $modules,
                'form' => $form->createView()
            )
        );
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/module/add", name="add_module")
     */
    public function addModuleAction(Request $request)
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()){

            /*$kernel = $this->get('kernel');
            $application = new Application($kernel);
            $application->setAutoExit(false);

            $input = new ArrayInput(array(
                'command' => 'csv:import',
            ));

            $output = new BufferedOutput();

            $application->run($input, $output);*/
            $em = $this->getDoctrine()->getManager();

            $em->persist($module);
            $em->flush();


            return $this->redirectToRoute('list_module');
        }

        return $this->render('ManagementBundle:Module:addEdit.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }


    public function importData($filePath,$cvName){

            $utilisateurs = array(); // Tableau qui va contenir les éléments extraits du fichier CSV
            $row = 0; // Représente la ligne
            // Import du fichier CSV
            if (($handle = fopen($filePath."/".$cvName, "r")) !== FALSE) {
                fgetcsv($handle);// Lecture du fichier, à adapter
                while (($fileData = fgetcsv($handle, 1000, ",")) !== FALSE) { // Eléments séparés par un point-virgule, à modifier si necessaire
                    //$num = count($fileData); // Nombre d'éléments sur la ligne traitée
                    $row++;
                    //for ($c = 0; $c < $num; $c++) {
                        $utilisateurs[$row] = array(
                            "code" => $fileData[0],
                            "title" => $fileData[1],
                            "hours" => $fileData[2],
                            "coefficient" => $fileData[3]
                        );
                    //}
                }
                fclose($handle);
            }


            return $utilisateurs;


    }
}