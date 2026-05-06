
<!-- Button Top -->
<a id="scroll-top" class="button-go"></a>
<!-- Button Top -->

<!-- Modal -->
<div class="modal fade" id="exampleModalToggle" aria-hidden="true"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="content-re-lo">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="title">Register</div>
                <div class="register-form">
                    <div class="respond-register-form">
                        <form method="post" class="comment-form form-submit" action="/" accept-charset="utf-8"
                              novalidate="novalidate">
                            <fieldset>
                                <label>User name</label>
                                <input type="text" class="tb-my-input" name="text" placeholder="User name">
                            </fieldset>
                            <fieldset>
                                <label>Email</label>
                                <input type="email" class="tb-my-input" name="email" placeholder="Email">
                            </fieldset>
                            <fieldset>
                                <label>Password</label>
                                <input type="password" class="input-form password-input"
                                       placeholder="Your password">
                            </fieldset>
                            <fieldset>
                                <label>Confirm password</label>
                                <input type="password" class="input-form password-input"
                                       placeholder="Confirm password">
                            </fieldset>
                            <button class="sc-button" name="submit" type="submit">
                                <span>Sign Up</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-box text-center mt-30">Allready have an account? <a class="color-popup "
                                                                                     data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                                                     data-bs-dismiss="modal">Login</a></div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="content-re-lo">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="title">Login</div>
                <div class="register-form">
                    <div class="respond-register-form">
                        <form method="post" class="comment-form form-submit" action="#" accept-charset="utf-8">
                            <fieldset>
                                <label>Account</label>
                                <input type="email" id="email" class="tb-my-input" name="email"
                                       placeholder="Email or user name">
                            </fieldset>
                            <fieldset>
                                <label>Password</label>
                                <input type="password" class="input-form password-input"
                                       placeholder="Your password">
                            </fieldset>
                            <div class="title-forgot t-al-right mb-20"><a class="t-al-right"
                                                                          data-bs-target="#exampleModalToggle3" data-bs-toggle="modal"
                                                                          data-bs-dismiss="modal">Forgot password</a>
                            </div>
                            <button class="sc-button" name="submit" type="submit">
                                <span>Login</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-box text-center mt-30">Don’t you have an account? <a class="color-popup"
                                                                                      data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                                                                                      data-bs-dismiss="modal">Register</a></div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle3" aria-hidden="true"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="content-re-lo">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="title">Forgot your password?</div>
                <div class="register-form">
                    <div class="respond-register-form">
                        <form method="post" class="comment-form form-submit" action="#" accept-charset="utf-8">

                            <fieldset>
                                <label>Password</label>
                                <input type="password" class="input-form password-input"
                                       placeholder="Your password">
                            </fieldset>
                            <button class="sc-button" name="submit" type="submit">
                                <span>Get new password</span>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-box text-center mt-30"><a class="color-popup" data-bs-target="#exampleModalToggle2"
                                                           data-bs-toggle="modal" data-bs-dismiss="modal">Back to Login</a></div>
            </div>

        </div>
    </div>
</div><!-- Modal -->

<!-- Modal-drive -->
<div class="modal  fade" id="test-driver" aria-hidden="true"  tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h4 class="title-form">Запись на тест-драйв</h4>

            <form action="{{ route('form.submit') }}" method="post">
                @csrf
                <input type="hidden" name="type" value="test_drive">

                <div class="group-form">
                    <input name="date" type="date" required>
                </div>

                <div class="group-form">
                    <select name="time">
                        <option>10:00 - 11:00</option>
                        <option>11:00 - 12:00</option>
                        <option>13:00 - 14:00</option>
                    </select>
                </div>

                <div class="group-form">
                    <input name="name" placeholder="Ваше имя" type="text" required>
                </div>

                <div class="group-form">
                    <input name="phone" placeholder="Телефон" type="tel" required>
                </div>

                <input type="submit" value="Отправить заявку">
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="offer-price" aria-hidden="true"  tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h4 class="title-form">Make An Offer Price</h4>
            <form action="/" method="post" class="offer-price-form" aria-label="Contact form"
                  novalidate="novalidate" data-status="init">
                <div class="group-form">
                    <input class="test-driver-name" placeholder="Enter Your Name Here" value="" type="text">
                </div>
                <div class="group-form">
                    <input class="test-driver-mail" placeholder="Email" value="" type="email">
                </div>
                <div class="group-form">
                    <input class="test-driver-form" placeholder="Your Phone" value="" type="tel">
                </div>
                <div class="group-form">
                    <input class="trade-price" placeholder="Trade Price" value="" type="text">
                </div>
                <input class="test-driver-submit" type="submit" value="Send Request">
            </form>
        </div>
    </div>
</div>
<!-- Modal-price -->
