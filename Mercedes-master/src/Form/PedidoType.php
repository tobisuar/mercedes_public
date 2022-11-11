<?php

namespace App\Form;

use App\Entity\Pedido;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class PedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre')
            ->add('Detalle')
            ->add('Deuda')
            ->add('Estado', ChoiceType::class, ['choices' =>[ 'Paga' => 'Paga' , 'No Paga' =>'No Paga' , 'En Proceso' => 'En Proceso']])
            ->add('PedidoDeCompra', FileType::class, [ 'label' => 'Pedido de compra', 'mapped' => false, 'required' => false ])
            ->add('Vale', FileType::class, [ 'label' => 'Vale', 'mapped' => false, 'required' => false ])
            ->add('Factura', FileType::class, [ 'label' => 'Factura', 'mapped' => false, 'required' => false ])
            ->add('proveedor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pedido::class,
        ]);
    }
}
