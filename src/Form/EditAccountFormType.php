<?php
	namespace App\Form;
	use App\Entity\Customer;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class EditAccountFormType extends AbstractType {
		public function buildForm(FormBuilderInterface $builder, array $options): void {
			$builder
				->add("customer_password", PasswordType::class, [
					"label" => "Mot de passe",
					"required" => false
				])
				->add("submit", SubmitType::class, [
					"label" => "Enregistrer"
				]);
		}
		public function configureOptions(OptionsResolver $resolver): void {
			$resolver->setDefaults([
				"data_class" => Customer::class
			]);
		}
	}
?>