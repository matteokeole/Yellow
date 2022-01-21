<?php
	namespace App\Form;
	use App\Entity\Customer;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class SignupFormType extends AbstractType {
		public function buildForm(FormBuilderInterface $builder, array $options): void {
			$builder
				->add("customer_first_name", TextType::class, [
					"label" => "Votre prénom *",
					"required" => false
				])
				->add("customer_last_name", TextType::class, [
					"label" => "Votre nom *",
					"required" => false
				])
				->add("customer_email", TextType::class, [
					"label" => "Votre email *",
					"required" => false
				])
				->add("customer_phone", TextType::class, [
					"label" => "Votre téléphone",
					"required" => false
				])
				->add("customer_password", PasswordType::class, [
					"label" => "Votre mot de passe *",
					"required" => false
				])
				->add("customer_address", TextType::class, [
					"label" => "Votre adresse postale *",
					"required" => false
				])
				->add("customer_post_code", TextType::class, [
					"label" => "Votre code postal *",
					"required" => false
				])
				->add("customer_city", TextType::class, [
					"label" => "Votre ville *",
					"required" => false
				])
				->add("submit", SubmitType::class, [
					"label" => "S'inscrire"
				]);
		}
		public function configureOptions(OptionsResolver $resolver): void {
			$resolver->setDefaults([
				"data_class" => Customer::class
			]);
		}
	}
?>