function checkForm(form)
{
	form.classList.add('was-validated');

	var filtre_cp = new RegExp("[0-9]{2}[ ]?[0-9]{3}");
	var filtre_mail = new RegExp("[a-z0-9]+[.-_]?[a-z0-9]*[@]{1}[a-z]+[.][a-z]+");
	var filtre_lettre = new RegExp("[a-z]+"); //refaire le reg exp affin de prendre en compte les prénoms composés ou avec un caractère spécial.
	var code_postal = form.elements['code_postal'].value;	
	var mail = form.elements['email'].value;
	var nom = form.elements['nom'].value;
	var prenom = form.elements['prenom'].value;
	var sujet = form.elements.sujet.value;
	var question = form.elements['question'].value;
	var box = form.elements['box'];
	var radio = form.elements.sexe.value; // les valeurs returnées sont homme ou femme (il s'agit de la value dans le html)
	var ddn = form.elements['date'].value;

	if (filtre_cp.test(code_postal) && filtre_mail.test(mail) && filtre_lettre.test(nom) && filtre_lettre.test(prenom) && filtre_lettre.test(question))
	{
		if (sujet == "mes_commandes" || sujet == "question_sur_un_produit")
		{
			if (radio == "homme" || radio == "femme")
			{
				if (box.checkValidity() == true)
				{
					if (ddn !== '' || null )
					{
						return true;
					}
					else 
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else 
			{
				return false;
			}
		}
		else 
		{
			return false;
		}
	}
	else 
	{
		return false;
	}
}