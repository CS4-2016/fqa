          <form action="register2.php" method="POST">
          <div class="top-row">
            <div class="field-wrap">
              <label>
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name="textFname"/>
            </div>
        
            <div class="field-wrap">
              <label>
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name="textLname"/>
            </div>
          </div>

          <div class="field-wrap">
            <select name="selectPosition" class="selectPosition" required>
              <option selected="true" disabled>--Select Postion*--</option>
              <option value="1">Dean</option>
              <option value="2">Chair</option>
              <option value="3">VPA</option>
              <option value="4">QA</option>
            </select>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="textEmail"/>
          </div>
          
          <div class="field-wrap">
           
            <div class="c9-password-show">
                 <label>
              Password<span class="req">*</span>
            </label>
                <input type="password"required autocomplete="off" name="textPassword" class="c9-password" id="password"/>
                 <i class="fa fa-eye show-off" id="showPassword"></i>
            </div>
          </div>

           <div class="field-wrap">
               <div class="c9-password-show">
                 <label>
                    Confirm Password<span class="req">*</span>
                 </label>
                  <input type="password"required autocomplete="off" name="textCpassword" class="c9-password2" id="confirm_password" />
                   <i class="fa fa-eye show-off2" id="showPassword2"></i>
               </div>
          </div>
          
          <button type="submit" class="button button-block btn btn-primary" id="btnSubmit"/>Get Started</button>
          </form>