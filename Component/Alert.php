                        <!-- PHP SCRIPT -->
                        <?php if (isset($_SESSION['response'])) : ?>
                            <div class="alert alert-<?= $_SESSION['res-type']; ?> alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?php
                                echo $_SESSION['response'];
                                unset($_SESSION['response']);
                                ?>
                            </div>
                        <?php endif; ?>
                        <!-- PHP SCRIPT -->