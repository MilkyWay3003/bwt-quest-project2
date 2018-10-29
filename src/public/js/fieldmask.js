$("#phone").mask("+9 (999) 999-9999");

$("#birthdate")
    .datepicker({ dateFormat: "dd/mm/yy", nextText: "", prevText: "", changeMonth: true, changeYear: true })
    .mask("99/99/9999");

populateCountries('country');
