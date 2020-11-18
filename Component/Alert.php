                        <!-- PHP SCRIPT -->
                        <?php if (isset($_GET['response'])) : ?>
                            <div class="alert alert-<?= $_GET['res-type']; ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php
                                echo $_GET['response'], ' ';
                                if (isset($_SESSION['temp_role'])) {
                                    echo $_SESSION['temp_role'], ' of AIA.';
                                    unset($_SESSION['temp_role']);
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <!-- PHP SCRIPT -->

                        <!-- For Login's -->
                        <?php if (isset($_SESSION['login-response'])) : ?>
                            <div class="alert alert-<?= $_SESSION['login-res-type']; ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php
                                echo $_SESSION['login-response'];
                                unset($_SESSION['login-response']);
                                unset($_SESSION['login-res-type'])
                                ?>
                            </div>
                        <?php endif; ?>
                        <!-- For Login's -->

                        <!-- For Register's -->
                        <?php if (isset($_SESSION['register-response'])) : ?>
                            <div class="alert alert-<?= $_SESSION['register-res-type']; ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php
                                echo $_SESSION['register-response'];
                                unset($_SESSION['register-response']);
                                unset($_SESSION['register-res-type'])
                                ?>
                            </div>
                        <?php endif; ?>
                        <!-- For Register's -->