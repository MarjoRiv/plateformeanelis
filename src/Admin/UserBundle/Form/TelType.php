<?php
namespace Admin\UserBundle\Form;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 
class TelType extends AbstractType
{
    /**
     * @author  Joe Sexton <joe@webtipblog.com>
     * @return  string
     */
    public function getName()
    {
        return 'tel';
    }
 
    /**
     * @author  Joe Sexton <joe@webtipblog.com>
     * @return  string
     */
    public function getParent()
    {
        return 'text';
    }
}