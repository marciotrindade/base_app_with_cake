<?php

// This file is used to add project constants or other stuff used in global scope of project.
Configure::write("Project.name", "Base");
Configure::write("Project.alias", "base");
Configure::write("Project.mail", "noreply@base.com");

// SMTP configuration
Configure::write("Smtp.host", "mail.dominio.com");
Configure::write("Smtp.username", "user@dominio.com");
Configure::write("Smtp.password", "password");
Configure::write("Smtp.port", "25");
Configure::write("Smtp.timeout", "10");

// Error message for validation
define("MSG_REQUIRED",     "This field is required.");
define("MSG_EMAIL",        "Please enter a valid email address.");
define("MSG_URL",          "Please enter a valid URL.");
define("MSG_DATE",         "Please enter a valid date.");
define("MSG_NUMBER",       "Please enter a valid number.");
define("MSG_ALPHANUMERIC", "Please enter only letters and numbers.");
define("MSG_CREDITCARD",   "Please enter a valid credit card.");
define("MSG_EQUALTO",      "Please enter the same value again.");
define("MSG_POSTAL",       "Please enter a valid zipcode.");
define("MSG_MAXLENGTH",    "Please enter no more than %s characters.");
define("MSG_MINLENGTH",    "Please enter at least %s characters.");
define("MSG_BETWEEN",      "Please enter a value between %s and %s characters long.");

// access controller
Configure::write("base.authorization", array(
	"auth" => ""
));

// date time
Configure::write("format.date", "m/d/Y");
Configure::write("format.time", "H:i:s");
Configure::write("format.datetime", "m/d/Y H:i:s");

?>