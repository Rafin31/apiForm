
// var bg_img = document.getElementById("bg_img").textContent;
// var clientIP = document.getElementById("clientIP").textContent;
// var FirstButton = document.getElementById("FirstButton").textContent;
// var SecondButtonColor = document.getElementById("SecondButtonColor").textContent;
// var userPhonePrefix = document.getElementById("userPhonePrefix").textContent;
// var FirstButtonColor = document.getElementById("FirstButtonColor").textContent;
// var SecondButton = document.getElementById("SecondButton").textContent;

// var SecondInputBoxPlaceholder = document.getElementById("SecondInputBoxPlaceholder").textContent;
// var FormTitle = document.getElementById("FormTitle").textContent;
// var FormTitleColor = document.getElementById("FormTitleColor").textContent;
// var FirstInputBoxPlaceholder = document.getElementById("FirstInputBoxPlaceholder").textContent;
// var SecondInputBoxPlaceholder = document.getElementById("SecondInputBoxPlaceholder").textContent;
// var ThirdInputBoxPlaceholder = document.getElementById("ThirdInputBoxPlaceholder").textContent;
// var FourthInputboxplaceholder = document.getElementById("FourthInputboxplaceholder").textContent;
// var FifthInpurBoxPlaceholder = document.getElementById("FifthInpurBoxPlaceholder").textContent;
// var checkBoxText = document.getElementById("checkBoxText").textContent;
// var checkBoxTextColor = document.getElementById("checkBoxTextColor").textContent;
// var SecondButtonTextColor = document.getElementById("SecondButtonTextColor").textContent;
// var FirstButtonTextColor = document.getElementById("FirstButtonTextColor").textContent;



let formWrapper = document.getElementById('form__wrapper');

formWrapper.innerHTML = `

<div class="form__great__wrapper" id="form__great__wrapper" style="background-image: url('../Assets/images/${bg_img}');">

            <div class="container">
                <h3 class=" text-center mb-5" style="color:${FormTitleColor};">${FormTitle}</h3>
                <div class="row justify-content-center ">

                    <div class="col-12 col-lg-7 col-md-7 ">

                        <div class="form__wrapper">
                            <form method="post" action="#">
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <input type="text" class="form-control" name="first_name" id="inputEmail4" placeholder="${FirstInputBoxPlaceholder}">
                                        <span style="color: red; font-weight: 600;" class="mt-2"><?= $first_name_error  ?></span>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <input type="text" class="form-control" name="${SecondInputBoxPlaceholder}" id="inputPassword4" placeholder="Last Name">
                                        <span style="color: red; font-weight: 600;" class="mt-2"><?= $last_name_error  ?></span>
                                    </div>
                                </div>
                                <div class="form-group">

                                    <input type="email" name="email" class="form-control" id="inputAddress" placeholder="${ThirdInputBoxPlaceholder}">
                                    <span style="color: red; font-weight: 600;" class="mt-2"><?= $email_error  ?></span>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <input type="text" class="form-control" name="password" id="password" placeholder="${FourthInputboxplaceholder}">
                                        <span style="color: red; font-weight: 600;" class="mt-2"><?= $password_error  ?></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button class="button_custom first_button" style="background-color:${FirstButtonColor} ; color:${FirstButtonTextColor};" id="generate_password">
                                            ${FirstButton}</button>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-2">
                                        <input type="text" class="form-control" name="phone_prefix" id="phone_prefix" value=${userPhonePrefix} readonly="readonly">
                                    </div>

                                    <div class="form-group col-md-10">
                                        <input type="number" class="form-control" id="phone_number" placeholder="${FifthInpurBoxPlaceholder}" name="phone_number">
                                        <span style="color: red; font-weight: 600;" class="mt-2"><?= $phone_number_error  ?></span>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" name="checkbox" type="checkbox" id="radio_button">

                                       <span style="color:${checkBoxTextColor};" > ${checkBoxText}</span>
                                        </label>
                                        <br>
                                        <span style="color: red; font-weight: 600;" class="mt-2"><?= $checkbox_error  ?></span>
                                    </div>
                                </div>
                                <button type="submit" name="submit" style="background-color:${SecondButtonColor};color:${SecondButtonTextColor};" class="button_custom second_button"> ${SecondButton}</button>
                            </form>

                        </div>



                    </div>
                </div>


            </div>

        </div>
        `


document.getElementById("generate_password").addEventListener('click', (event) => {

    const randomPassword = Math.random().toString(36).slice(-8);
    document.getElementById("password").value = randomPassword;
    event.preventDefault();
})