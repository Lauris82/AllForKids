<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 12/02/2018
 * Time: 01:51
 */

namespace PIdev\AllforkidsBundle\EventListener;
    use Symfony\Component\HttpFoundation\File\UploadedFile;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use Doctrine\ORM\Event\PreUpdateEventArgs;
    use PIdev\AllforkidsBundle\Entity\User;
    use PIdev\AllforkidsBundle\ImageUpload;
    class ImageUploadListener
    {
        private $uploader;

        public function __construct(ImageUpload $uploader)
        {
            $this->uploader = $uploader;
        }

        public function prePersist(LifecycleEventArgs $args)
        {
            $entity = $args->getEntity();

            $this->uploadFile($entity);
        }

        public function preUpdate(PreUpdateEventArgs $args)
        {
            $entity = $args->getEntity();

            $this->uploadFile($entity);
        }

        private function uploadFile($entity)
        {
            // upload only works for Product entities
            if (!$entity instanceof User) {
                return;
            }

            $file = $entity->getImage();

            // only upload new files
            if (!$file instanceof UploadedFile) {
                return;
            }

            $fileName = $this->uploader->upload($file);
            $entity->setImage($fileName);
        }

}