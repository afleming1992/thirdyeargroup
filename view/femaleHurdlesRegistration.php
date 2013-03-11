
<div class='span9 contentbox'>

<form id="frmContact" name="frmContact" method="post" action="index.php">
        <fieldset id="personalInfo">
            <legend><strong>Female Hurdles: Personal Information</strong></legend>
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
              <label for="emcontact">*Emergency Contact Number: </label>
              <input name="emcontact" type="text" class="text" id="emcontact" tabindex="130" />
              <p><font color="red"><span id="emcontacterror"</span></font></p>
            </p>
            <p>Do you have a performance time? </p>
            <label for="s1">Yes</label>
            <input type="radio" id="radio1" name="yesno" value="Yes"/>
            <br/>
            <label for="s2">No</label>
            <input type="radio" id="radio2" name="yesno" value="No"/>
			<p><font color="red"><span id="performancetimeerror"</span></font></p>
			<div id = "performancetime">
            <p>
              <label for="minutes">Minutes:</label>
              <input name="minutes" class = "time" type="text" class="text" id="minutes" maxlength = "2" tabindex="130"/>
              <label for="seconds">Seconds:</label>
              <input name="seconds" class = "time" type="text" class="text" id="seconds" maxlength = "2" tabindex="130"/>
              <label for="milliseconds">Milliseconds:</label>
              <input name="milliseconds" class = "time" type="text" class="text" id="milliseconds" maxlength = "4" tabindex="130"/>
            </p>
            </div>
            <p>
              <input name="gender" type="hidden" id="gender" tabindex="130" value="F" />
            </p>
            <p> (* Required Fields) </p>
            <p>
              <button class="btn" type="submit" name="submit2" id="submitBtn" tabindex="300" ><i class ="icon-ok"></i> Submit</button>
            </p>
            <script src="javascript/femaleHurdles.js"></script>
          </fieldset>
        </form>
<style type="text/css">
  .time {
    width: 50px
}
  </style>
        
        
