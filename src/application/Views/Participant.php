<div id="map" data-address="<?=ADRESS?>"></div>
<div class="container">
    <form id="userRegistrationData" action="/ParticipantController/UserRegistrationSubmit" class="form-horizontal"  method="post" >

      <div class="formtitle"><?php echo TITLE_FORM ?> </div>
      <div class="memberref"> <a href="/ParticipantController/Allmembers">All members (178)</a></div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="firstname">FirstName</label>
        <div class="col-md-6">
          <input type="text" id="firstname" class="form-control" placeholder="FirstName" name="firstname" autofocus>
            <?php if(isset($errors) && array_key_exists('firstname', $errors)): ?>
              <span class="error text-danger">Please enter correct length firstname  </span>
            <?php endif; ?>
        </div>
        <div class="col-md-3 messages"></div>
      </div>

       <div class="form-group">
        <label class="col-md-3 control-label" for="lastname">LastName</label>
        <div class="col-md-6">
          <input type="text" id="lastname" class="form-control" placeholder="LastName" name="lastname">
            <?php if(isset($errors) && array_key_exists('lastname', $errors)): ?>
              <span class="error text-danger">Please enter correct length lastname </span>
            <?php endif; ?>
        </div>
        <div class="col-md-3 messages"></div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="birthdate">BirthDate</label>
        <div class="col-md-6">
          <input type="text" id="birthdate" class="form-control" placeholder="DD / MM / YYYY" name="birthdate">
            <?php if(isset($errors) && array_key_exists('birthdate', $errors)): ?>
            <span class="error text-danger">Please enter correct birthdate</span>
          <?php endif; ?>
        </div>
        <div class="col-md-3 messages"></div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="reportsubject" >Report Subject</label>
        <div class="col-md-6">
           <input type="text" id="reportsubject" class="form-control" placeholder="Report Subject" name="reportsubject">
             <?php if(isset($errors) && array_key_exists('reportsubject', $errors)): ?>
             <span class="error text-danger">Please enter reportsubject</span>
             <?php endif; ?>
         </div>
         <div class="col-md-3 messages"></div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="country" >Country</label>
        <div class="col-md-6">
           <select name="country" id="country" class="form-control"></select>
              <?php if(isset($errors) && array_key_exists('country', $errors)): ?>
              <span class="error text-danger">Please enter country</span>
           <?php endif; ?>
        </div>
        <div class="col-md-3 messages"></div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="phone">Phone</label>
        <div class="col-md-6">
            <input type="text" id="phone" class="form-control" placeholder="+X (XXX) XXX-XXXX" name="phone">
            <?php if(isset($errors) && array_key_exists('phone', $errors)): ?>
            <span class="error text-danger">Please enter phone</span>
        <?php endif; ?>
        </div>
        <div class="col-md-3 messages"></div>
      </div>

      <div class="form-group">
        <label class="col-md-3 control-label" for="email" >Email</label>
        <div class="col-md-6">
           <input type="text" id="email" class="form-control" placeholder="Email address" name="email">
            <?php if(isset($errors) && array_key_exists('email', $errors)): ?>
            <span class="error text-danger">Please enter correct email</span>
            <?php endif; ?>
           </div>
        <div class="col-md-3 messages"></div>
      </div>


       <div class="form-group">
       <div class="col-md-6 col-md-offset-3">
        <div class="text-right">
          <button class="btn btn-lg btn-primary " type="submit" name="submitRegData">Next</button>
          </div>
      </div>

    </form>
  </div>
  </div>

  <div class="container">
      <form action="/ParticipantController/UserAdditionalInfo" class="form-horizontal" id="userAdditionalInfo" method="post" enctype="multipart/form-data">

      <div class="formtitle"><?php echo TITLE_FORM?> </div>
      <div class="memberref"> <a href="/ParticipantController/Allmembers">All members (178)</a></div>
        <input type="hidden" id="userId" name="userId" value="">
        <div class="form-group">
          <label class="col-md-3 control-label" for="inputCompany">Company</label>
           <div class="col-md-6">
             <input type="text" id="inputCompany" class="form-control" placeholder="Company" name="company" autofocus>
              <?php if(isset($errors) && array_key_exists('company', $errors)): ?>
              <span class="help-block">Please enter company</span>
            <?php endif; ?>
            </div>
           <div class="col-md-3 messages"></div>
        </div>

        <div class="form-group">
          <label class="col-md-3 control-label" for="inputPosition">Position</label>
           <div class="col-md-6">
             <input type="text" id="inputPosition" class="form-control" placeholder="Position" name="position">
             <?php if(isset($errors) && array_key_exists('position', $errors)): ?>
              <span class="help-block">Please enter position</span>
             <?php endif; ?>
           </div>
           <div class="col-md-3 messages"></div>
        </div>

         <div class="form-group">
           <label class="col-md-3 control-label" for="inputAboutMe" class="sr-only">About me</label>
           <div class="col-md-6">
             <textarea id="inputAboutMe" cols="72" rows="4" class="form-control" placeholder="About me" name="aboutme"></textarea>
               <?php if(isset($errors) && array_key_exists('aboutme', $errors)): ?>
               <span class="help-block">Please enter about me</span>
             <? endif; ?>
           </div>
          <div class="col-md-3 messages"></div>
         </div>

         <div class="form-group">
           <label class="col-md-3 control-label" for="uploadFoto" class="sr-only">Photo</label>
           <div class="col-md-6">
             <input type="file" id="uploadFoto" name="photo" accept="image/gif, image/png, image/jpeg">
              <?php if(isset($errors) && array_key_exists('photo', $errors)): ?>
              <span class="help-block">Please download foto</span>
              <?php endif; ?>
           </div>
         <div class="col-md-3 messages"></div>
         </div>

        <div class="form-group">
         <div class="col-md-6 col-md-offset-3">
           <div class="text-right">
          <button id="upload" class="btn btn-lg btn-primary" type="submit" name="submitAddInfo" value="Upload">Next</button>
          </div>
         </div>
        </div>
      </form>
      <br><br>
    </div>
</div>
</div>

  <div id ="button-social-network">
    <div class="container">
      <div class="col-md-6 col-md-offset-3">

        <div id="fb-root"></div>
        <div class="fb-share-button"
          data-href="http://<?php echo $page_url ?>"
          data-layout="button_count">
        </div>

        <a class="twitter-share-button"
          href="https://twitter.com/share"
          data-text= "<?php echo TW_TEXT ?>"
          data-url="http://<?php echo $page_url ?>"
          data-show-count="false">
          Tweet
        </a>

        <div class="g-plus"
          data-action="share"
          data-href="http://<?php echo $page_url ?>">
        </div>
      </div>
    </div>
  </div>
</div>



<script src="/js/userAdditionalInfo.js"></script>
<script src="/js/userRegistrationData.js"></script>
<script src="/js/buttons.js"></script>
<script src="/js/countries.js"></script>
<script src="/js/fieldmask.js"></script>
<script src="/js/googlemap.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_API_KEY?>&callback=initMap"></script>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<script src="https://apis.google.com/js/platform.js" async defer>  {lang: 'en-GB'}   </script>

