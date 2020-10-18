<?php
/**
 * Email footer
 *
 * @author  Adrian Lopez Gonzalez - DEIDEAS Marketing Solutions
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- End Content -->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Body -->
                                </td>
                            </tr>
                       </table>
                       <table>
                            <tr>
                                <td align="center" valign="top">
                                    <!-- Footer -->
                                    <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
                                        <tr>
                                            <td valign="top">
                                                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                                    <?php 

                                                    $copy = get_field("theme_settings_email__copyright", "option");

                                                    $legal = get_field("theme_settings_email__legal", "option");

                                                    $social_networks_enabled = get_field("theme_settings_email__social_networks_in_mail", "option");

                                                    if ( $copy ) : ?>
                                                        <tr>
                                                            <td colspan="2" valign="middle" id="social-networks">
                                                                <div class="body_content_inner">
                                                                <?php if(!empty($copy)){
                                                                    echo '<p style="font-size: 14px; font-weight: 600;">' . $copy . '</p>';

                                                                } ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>

                                                    <?php 
                                                    if ( $social_networks_enabled ) : ?>
                                                        <tr>
                                                            <td colspan="2" valign="middle" id="social-networks">
                                                                <div class="body_content_inner"><?php 

                                                                $url_facebook = get_field("theme_settings_social__facebook", "option");
                                                                $url_twitter = get_field("theme_settings_social__twitter", "option");
                                                                $url_google = get_field("theme_settings_social__google", "option");

                                                                if(!empty($url_facebook)){
                                                                    echo '<a href="http://' . $url_facebook . '" style="margin: 0 7px; text-decoration: none" rel="noreferrer" target="_blank">';
                                                                    echo '<img style="border: none; width: 24px; min-height: 24px" alt="facebook" height="24" width="24" src="https://ci3.googleusercontent.com/proxy/aUicCc4NdusQfi3ux5w1xc_W5e2R1HlMYstS_aQ6liVbRB1TsgAB-l5_yEJEEHWCqZMbVyii12gDJNbCk0JzfpWZqlHTHVFN3HGXHnzC-hvcyM7HERXEs8kEBmbORdW2fA=s0-d-e1-ft#https://dt5zaw6a98blc.cloudfront.net/site-static/images/footer/facebook.png">';
                                                                    echo '</a>';
                                                                }

                                                                if(!empty($url_twitter)){
                                                                    echo '<a href="http://' . $url_twitter . '" style="margin: 0 7px; text-decoration: none" rel="noreferrer" target="_blank">';
                                                                    echo '<img style="border: none; width: 24px; min-height: 24px" alt="twitter" height="24" width="24" src="https://ci4.googleusercontent.com/proxy/pOgcjuE-Bq2LalyOyNZogZPg2IEQVKC7MGIONZZPy_R7mrdK1THvWtLYGPcBvRH3SdjV4jF4qRa8UwCwfsWMhU-d4rZ-AaANg_lMTsL2-nIV019B-ZhywO8_GFm-wD9b=s0-d-e1-ft#https://dt5zaw6a98blc.cloudfront.net/site-static/images/footer/twitter.png">';
                                                                    echo '</a>';
                                                                }

                                                                if(!empty($url_google)){
                                                                    echo '<a href="http://' . $url_google . '" style="margin: 0 7px; text-decoration: none" rel="noreferrer" target="_blank">';
                                                                    echo '<img style="border: none; width: 24px; min-height: 24px" alt="google plus" height="24" width="24" src="https://ci6.googleusercontent.com/proxy/dIqZnhsxwHq9wq3ifQyVbD5ZjkyDROkL46OaZ0N91mQ4fjSN6D-Mo9N7kyliVGHLQF8rxRWWcb3BEDYBzNT2xtsjrqEtvH1NeH0zYdiWbxXg98BdEV0flFbaqjOgsVXNi7y8=s0-d-e1-ft#https://dt5zaw6a98blc.cloudfront.net/site-static/images/footer/googleplus.png">';
                                                                    echo '</a>';
                                                                }

                                                                ?></div>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>
                                                    <tr>

                                                    <?php if ( $legal ) : ?>
                                                    <td data-lang="<?php echo $current_lang; ?>" colspan="2" style="font-size: 10px;color: #C1C1C1; font-family: 'DINPro-Regular', 'sans-serif';" valign="middle" id="legal-advice">
                                                        <?php echo $legal; ?>
                                                    </td>
                                                    <?php endif;?>
                                                
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Footer -->
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
