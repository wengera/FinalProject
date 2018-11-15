<?php
/*
 * Author: Louie Zhu
 * Date: Mar 6, 2016
 * Name: index.class.php
 * Description: This class defines the method "display" that displays the home page.
 */

class HomeIndex extends IndexView {

    public function getIcon($user, $index){
        $item = $user->GetItem($index);
        if ($item)
            return $item->GetIcon($index);
        else
            return "";
    }
    
    public function display($user, $vendor) {
        //display page header
        parent::displayHeader("");
        parent::displayFloatingDetails();
        ?>    

            
        <div class="container-fluid"><div class="row">
            <div class="col-lg-6">
                <div class="container-fluid" id="playerInventoryContainer">
                    <div class="row">
                        <div class="col-lg-*">
                            <h1 style="color: white;"> <?= $user->GetUsername() ?> </h1>
                        </div>
                        <div class="col-lg-*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="0" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 0) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="1" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 1) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="2" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 2) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="3" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 3) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="4" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 4) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="5" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 5) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="6" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 6) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="7" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 7) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="8" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 8) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="9" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 9) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="10" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 10) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="11" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 11) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="12" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 12) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="13" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 13) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="14" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 14) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="15" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 15) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="16" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 16) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="17" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 17) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="18" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 18) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="19" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($user, 19) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="container-fluid" id="playerInventoryContainer">
                    <div class="row">
                        <div class="col-lg-*">
                            <h1 style="color: white;"> <?= $vendor->GetUsername() ?> </h1>
                        </div>
                        <div class="col-lg-*">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="0" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 0) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="1" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 1) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="2" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 2) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="3" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 3) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="4" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 4) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="5" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 5) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="6" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 6) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="7" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 7) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="8" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 8) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="9" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 9) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="10" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 10) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="11" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 11) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="12" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 12) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="13" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 13) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="14" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 14) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="15" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 15) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="16" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 16) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="17" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 17) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="18" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 18) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-*">
                            <div class="card" id="itemCard">
                                <div class="card-body" id="itemCardBody">
                                <form method="POST" action="details">
                                    <input type="hidden" name="itemId" value="19" />
                                    <input type="image" onmouseover="toggleFloatingDetails(true)" onmouseleave="toggleFloatingDetails(false)" src="<?= self::getIcon($vendor, 19) ?>" id="itemIcon" alt="" />
                              </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    
    
    if (!$user){
        echo "Failed to retrieve user";
    }
?>
        
        

        <?php
        //display page footer
        parent::displayFooter();
    }

}
