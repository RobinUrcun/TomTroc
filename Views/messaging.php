<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="messaging_section">

    <div class="messaging_side_bar">
        <h1>
            Messagerie
        </h1>
        <div class="messaging_contact_wrapper">
            <div class="messaging_contact_avatar">
                <img src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="messaging_contact_content">
                <div class="messaging_contact_content_header">
                    <div class="messaging_contact_content_username">Alexlecture</div>
                    <div class="messaging_contact_content_last_message">15:43</div>
                </div>
                <div class="messaging_contact_content_preview">
                    Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                </div>
            </div>
        </div>
    </div>
    <div class="messaging_content">
        <div class="messaging_content_subtitle">
            <div class="messaging_contact_avatar">
                <img src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <h2>Alexlecture</h2>
        </div>
        <div class="messaging_content_messages">
            <div class="messaging_content_messages_wrapper">
                <div class="messaging_content_message_wrapper sent_message">
                    <div class="messaging_content_message_wrapper_bis">
                        <div class="message_info">
                            <p>
                                21.08
                            </p>
                            <p>
                                15:44
                            </p>
                        </div>
                        <div class="message_content">
                            Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                        </div>
                    </div>
                </div>

                <div class="messaging_content_message_wrapper received_message">
                    <div class="messaging_content_message_wrapper_bis">
                        <div class="message_info">
                            <div class="message_info_avatar">
                                <img src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
                            </div>
                            <p>
                                21.08
                            </p>
                            <p>
                                15:44
                            </p>
                        </div>
                        <div class="message_content">
                            Lorem ipsum dolor sit amet, consectetur .adipiscing elit, sed do eiusmod tempor
                        </div>
                    </div>
                </div>
            </div>
            <form class="messaging_content_form_wrapper">
                <label for=""></label>
                <textarea rows="1" placeholder="Tapez votre message ici" name="" id=""></textarea>
                <button class="main_button">Envoyer</button>
            </form>
        </div>
    </div>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>