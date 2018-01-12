<?php
    global $current_user;
    get_currentuserinfo();
?>
                    <div role="tabpanel" class="tab-pane active" id="welcome">
                        <div class="page-header">
                            <h3><i class="fa fa-star" aria-hidden="true"></i> <?php echo _e('Welcome','gogalapagos') . ' ' . $current_user->display_name; ?>!</h3>
                        </div>
                        <p>Go Galapagos Wordpress Theme (currently v0.1) has a few easy ways to quickly get started, each one appealing to a different skill level and use case. Read through to see what suits your particular needs.</p>
                        <p>GO Quickly and see this:</p>
                        <ul>
                            <li role="presentation" class="active"><a href="#welcome" aria-controls="welcome" role="tab" data-toggle="tab">Welcome</a> - You are here!</li>
                            <li role="presentation"><a href="#adminmanual" aria-controls="adminmanual" role="tab" data-toggle="tab">Administrator's Manual</a></li>
                            <li role="presentation"><a href="#usermanual" aria-controls="usermanual" role="tab" data-toggle="tab">User's Manual</a></li>
                            <li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab">Support</a></li>
                        </ul>
                    </div>
