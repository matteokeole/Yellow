<?php
	namespace App\Form;
	use App\Entity\Customer;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;

	class InscriptionFormType extends AbstractType {
		public function buildForm(FormBuilderInterface $builder, array $options): void {
			$builder
				->add("customer_first_name", TextType::class, [
					"label" => "Votre prénom *",
					"required" => true
				])
				->add("customer_last_name", TextType::class, [
					"label" => "Votre nom *",
					"required" => true
				])
				->add("customer_email", EmailType::class, [
					"label" => "Votre email *",
					"required" => true
				])
				->add("customer_phone", TextType::class, [
					"label" => ">Votre téléphone",
					"required" => false
				])
				->add("customer_password", PasswordType::class, [
					"label" => "Votre mot de passe *",
					"required" => true
				])
				->add("customer_address", TextType::class, [
					"label" => "Votre adresse postale *",
					"required" => true
				])
				->add("customer_post_code", IntegerType::class, [
					"label" => "Votre code postal *",
					"required" => true
				])
				->add("customer_city", TextType::class, [
					"label" => "Votre ville *",
					"required" => true
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