validate.extend(validate.validators.datetime, {
  parse: function(value, options) {
    return +moment.utc(value);
  },

  format: function(value, options) {
    var format = options.dateOnly ? "DD-MM-YY" : "DD-MM-YY hh:mm:ss";
    return moment.utc(value).format(format);
  }
});

var constraints = {
  firstname: {
    presence: true,
    length: {
      minimum: 2,
      maximum: 255
    },
    format: {
      pattern: "^[a-zA-Z0-9]*$",
      flags: "i",
      message: "can only contain A-Z, a-z and 0-9"
    }
  },

  lastname: {
    presence: true,
    length: {
      minimum: 2,
      maximum: 255
    },
    format: {
      pattern: "^[a-zA-Z0-9]*$",
      flags: "i",
      message: "can only contain A-Z, a-z and 0-9"
    }
  },

  birthdate: {
    presence: true,
    datetime: {
      dateOnly: true
    },
  },

  reportsubject: {
    presence: true,
    length: {
      minimum: 2,
      maximum: 255
    },
  },

  country: {
    presence: true,
  },

  phone: {
    presence: true,
  },

  email: {
    presence: true,
    email: true
  }
}

var form = document.querySelector("form#userRegistrationData");

var inputs = form.querySelectorAll("input, textarea, select");
for (var i = 0; i < inputs.length; ++i) {
  inputs.item(i).addEventListener("change", function(ev) {
    var errors = validate(form, constraints) || {};
    showErrorsForInput(this, errors[this.name])
  });
}

function handleFormSubmit(form, input) {
  var errors = validate(form, constraints);
  showErrors(form, errors || {});
  if (!errors) {   
    return true;
  }
    return false;
}

function showErrors(form, errors) {

  form.querySelectorAll("input[name], select[name]").forEach(function(input) {
    showErrorsForInput(input, errors && errors[input.name]);
  });
}

function showErrorsForInput(input, errors) {
  var formGroup = closestParent(input.parentNode, "form-group");
  var messages = formGroup.querySelector(".messages");
  resetFormGroup(formGroup);

  if (errors) {
    formGroup.classList.add("has-error");
    errors.forEach(function(error) {
      addError(messages, error);
    });
  } else {
    formGroup.classList.add("has-success");
  }
}

function closestParent(child, className) {
  if (!child || child == document) {
    return null;
  }
  if (child.classList.contains(className)) {
    return child;
  } else {
    return closestParent(child.parentNode, className);
  }
}
function resetFormGroup(formGroup) {

  formGroup.classList.remove("has-error");
  formGroup.classList.remove("has-success");

  formGroup.querySelectorAll(".help-block.error").forEach(function(el) {
    el.parentNode.removeChild(el);
  });
}

function addError(messages, error) {
  var block = document.createElement("p");
  block.classList.add("help-block");
  block.classList.add("error");
  block.innerText = error;
  messages.appendChild(block);
}

var flag = 'showSecondForm';

$('#userAdditionalInfo').hide();
$('#button-social-network').hide();

if (localStorage.getItem(flag)) {
  $('#userRegistrationData').hide();
  $('#userAdditionalInfo').show();
}

$('#userRegistrationData').on('submit', function () {
  event.preventDefault();
  var formValid =  handleFormSubmit(form);

  if (formValid) {
    var userRegistrationData = $("#userRegistrationData").serialize();

    axios.post('/ParticipantController/UserRegistrationSubmit', userRegistrationData)
          .then(function (response) {
            console.log(response);
            document.getElementById('userId').value = response.data.id;
            $('#userRegistrationData').hide();
            $('#userAdditionalInfo').show();
            localStorage.setItem(flag, true);
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
  };
});
