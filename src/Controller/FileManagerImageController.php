<?php

namespace TwinElements\FormExtensions\Controller;

use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use TwinElements\AdminBundle\Model\CrudControllerTrait;

class FileManagerImageController extends AbstractController
{
    use CrudControllerTrait;

    /**
     * @Route("/edit-filemanager-image", name="edit_filemanager_image", methods={"GET"})
     */
    public function editImage(
        Request $request
    )
    {
        if (!$request->query->has('image') || !$request->query->has('form-id')) {
            throw new \Exception('image or form id is not defined');
        }

        return $this->render('@TwinElementsFormExtensions/edit_filemanager_image.html.twig', [
            'image' => $request->query->get('image'),
            'form_id' => $request->query->get('form-id')
        ]);
    }

    /**
     * @Route("/crop-filemanager-image", name="crop_filemanager_image", methods={"GET", "POST"}, options={"i18n" = false, "expose"=true})
     */
    public function crop(
        Request $request
    )
    {
        try {
            if (!$request->isXmlHttpRequest()) {
                throw new Exception('only XmlHttpRequest');
            }

            if (!$request->files->get('croppedImage')) {
                throw new Exception('no image');
            }

            if (!is_uploaded_file($request->files->get('croppedImage'))) {
                throw new Exception('it is no uploaded file');
            }

            if (!$request->request->has('originalImagePath')) {
                throw new \Exception('No original image path');
            }

            $originalImageInfo = pathinfo($request->request->get('originalImagePath'));
            $originalImageDir = $originalImageInfo['dirname'] . '/';
            $originalImageFullDir = $request->server->get('DOCUMENT_ROOT') . $originalImageDir;
            $originalImageName = $originalImageInfo['filename'];

            /**
             * @var UploadedFile $file
             */
            $file = $request->files->get('croppedImage');


            $extension = $file->guessExtension();
            $croppedImageName = $originalImageName . '_mini.' . $extension;

            $file->move($originalImageFullDir, $croppedImageName);

            return new JsonResponse([
                'croppedImagePath' => $originalImageDir . $croppedImageName
            ]);

        } catch (\Exception $exception) {
            return new JsonResponse([
                'error' => $exception->getMessage()
            ]);
        }

    }
}
