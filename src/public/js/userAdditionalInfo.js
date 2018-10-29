$('#userAdditionalInfo').on('submit', function () {
     event.preventDefault();
     var userAdditionalInfo = new FormData();
     userAdditionalInfo.append('company', document.getElementById('inputCompany').value);
     userAdditionalInfo.append('position', document.getElementById('inputPosition').value);
     userAdditionalInfo.append('aboutme', document.getElementById('inputAboutMe').value);
     userAdditionalInfo.append('photo', document.getElementById('uploadFoto').files[0]);
     userAdditionalInfo.append('id', document.getElementById('userId').value);

     var settings = {
       headers: {
         'Content-Type': 'multipart/form-data'
       }
     }

     axios.post('/ParticipantController/UserAdditionalInfo', userAdditionalInfo, settings)
       .then(function (response) {
         console.log(response);
         localStorage.clear();
       })
       .catch(function (error) {
         console.log(error);
       });

       $('#button-social-network').show();
       $('#userAdditionalInfo').hide();    

  })






