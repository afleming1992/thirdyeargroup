
<div class='span9 contentbox'>

<form id="frmContact" name="frmContact" method="post" action="successTest.php">
        <fieldset id="personalInfo">
            <legend><strong>Personal Information</strong></legend>
        	<p>
              <label for="firstname">*First Name: </label>
              <input name="firstname" type="text" class="text" id="firstname" tabindex="100" />
              <p><font color="red"><span id="nameerror"</span></font></p>
            </p>
            <p>
              <label for="lastname">*Last Name: </label>
              <input name="lastname" type="text" class="text" id="lastname" tabindex="100" />
              <p><font color="red"><span id="lastnameerror"</span></font></p>
            </p>
            <p>
              <label for="dob">*Date of Birth: </label>
              <input name="dob" class="text" id="dob" tabindex="100" />
              <p><font color="red"><span id="date"</span></font></p>
            </p>
            <p>
            <hr>
              <label for="housenumber">*House No: </label>
              <input name="housenumber" type="text" class="text" id="housenumber" tabindex="140" />
              <p><font color="red"><span id="errorhousenumber"</span></font></p>
            </p>
            <p>
              <label for="streetname">*Street Name: </label>
              <input name="streetname" type="text" class="text" id="streetname" tabindex="140" />
              <p><font color="red"><span id="errorstreetname"</span></font></p>
            </p>
            <p>
              <label for="city">*City: </label>
              <input name="city" type="text" class="text" id="city" tabindex="140" />
              <p><font color="red"><span id="errorcity"</span></font></p>
            </p>
            <p>
              <label for="postcode">*Postcode: </label>
              <input name="postcode" type="text" class="text" id="postcode" tabindex="140" />
              <p><font color="red"><span id="errorpostcode"</span></font></p>
            </p>
            <hr>
            <p>
              <label for="emailcheck">*Email: </label>
              <input name="emailcheck" type="text" class="text" id="email" tabindex="110" />
              <p><font color="red"><span id="emailerror"</span></font></p>
            </p>
            <p>
              <label for="phone">*Emergency Contact Number: </label>
              <input name="emcontact" type="text" class="text" id="emcontact" tabindex="130" />
              <p><font color="red"><span id="emcontacterror"</span></font></p>
            </p>
            <p>
              <label for="phone">Performance Time: </label>
              <input name="phone" type="text" class="text" id="phone" tabindex="130" />
            </p>
            <p> (* Required Fields) </p>
            <p>
              <button class="btn" type="submit" name="submit2" id="submitBtn" tabindex="300" ><i class ="icon-ok"></i> Submit</button>
            </p>
            <script src="javascript/femaleHurdles.js"></script>
          </fieldset>
        </form>
        
        
