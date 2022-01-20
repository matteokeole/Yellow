<?php
	namespace App\Form;
	use App\Entity\Customer;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	// use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class LoginFormType extends AbstractType {
		public function buildForm(FormBuilderInterface $builder, array $options): void {
			$builder
				->add("customer_email", TextType::class, [
					"label" => "Votre email *",
					"required" => true
				])
				->add("customer_password", PasswordType::class, [
					"label" => "Votre mot de passe *",
					"required" => true
				])
				->add("submit", SubmitType::class, [
					"label" => "Se connecter"
				]);
		}
		public function configureOptions(OptionsResolver $resolver): void {
			$resolver->setDefaults([
				"data_class" => Customer::class
			]);
		}
	}
?>