                    <div role="tabpanel" class="tab-pane" id="support">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3><i class="fa fa-ambulance" aria-hidden="true"></i> Support</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5 support-text">
                                <p>En el departamento de sistemas, estámos encantados de poder ayudarle en lo que sea que podamos, por eso le habilitamos los siguientes canales para que usted tenga la posibilidad de enviarnos cualquier sugerencia, crítica o consulta.</p>
                                <p>Sírvase de hacerlo cuando y como guste!. <i class="fa fa-smile-o fa-3x text-success" aria-hidden="true"></i></p>
                            </div>
                            <div class="col-sm-3 support-text">
                                <h3 id="contacta">Contacte</h3>
                                <ul>
                                    <li><i class="fa fa-phone-square" aria-hidden="true"></i> Ext. 835 (Ing. Luis Caiza)</li>
                                    <li><i class="fa fa-envelope" aria-hidden="true"></i> sistema8@kleintours.com.ec</li>
                                </ul>
                                <?php
                                    global $current_user;
                                    get_currentuserinfo();
                                ?>
                                <h3>o Envíe un correo <?php echo $current_user->display_name; ?>!</h3>
                                <form id="support_form">
                                    <input type="hidden" name="gg_wp_user" value="<?php echo $current_user->display_name; ?>">
                                    <div class="form-group">
                                        <label for="mensaje">Escriba su mensaje</label>
                                        <textarea class="form-control" name="gg_mensaje" rows="5"></textarea>
                                    </div>
                                    <div id="send-message"></div>
                                    <button id="support-submit" type="submit" class="btn btn-success btn-support">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
