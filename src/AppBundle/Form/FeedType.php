<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Feed;

class FeedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {    
		$builder->add('name', EntityType::class, array(
				    'class' => 'AppBundle:Feed',
		    		'choice_label' => 'name'))
				->add('save', SubmitType::class, array('label' => 'Select...'));
    
    }
}
?>