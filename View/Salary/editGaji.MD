                    <?php
                    require_once '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
                    $data = $connection->query("SELECT name FROM employee  WHERE id = $employee_id");
                    while ($selectedEmployeeName = $data->fetch_assoc()) :
                        echo $selectedEmployeeName;
                        echo $data;
                    ?>
                        <option value="<?= $employee_id ?>" selected><?= $selectedEmployeeName ?></option>
                    <?php
                    endwhile;
                    ?>
                    <?php
                    require_once '/xampp/htdocs/PSW-SEM3/Payroll/Library/connection.php';
                    $data = $connection->query("SELECT * FROM employee  WHERE id != $employee_id");

                    while ($employees = $data->fetch_assoc()) :
                    ?>
                        <option value="<?= $employees['id'] ?>"><?= $employees['name'] ?> </option>
                    <?php
                    endwhile;
                    ?>
