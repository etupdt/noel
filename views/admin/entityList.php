<main class="container row mx-auto p-0">         
  <div class="d-flex flex-column flex-lg-row p-0">
    <div class="d-flex flex-column w-100 h-100">
      <div class="title pt-5">
        <h1><?php echo $nameMenu?></h1>
      </div>
      <div class="form">
        <div class="container p-0 form-div">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end my-4">
          <form action="<?php echo BASE_URL.ADMIN_URL."/".$nameEntity; ?>">
            <?php 
              $button = ['id' => "addButton" , 'value' => 'Ajouter', 'action' => 'i', 'method' => 'GET']; 
              require 'commandButton.php';
            ?>
          </form>  
          </div>
          <div class="col-12 table-responsive">
            <table class="table table-success table-striped m-0 table-data">
              <thead>
                <tr>
                  <?php
                    foreach ($fields as $field) {
                      if (!isset($field['hideInList']) || !$field['hideInList']) {
                        if ($field['name'] === 'id') {
                          echo '<th scope="col">Id</th>';
                        } else {
                          echo '<th scope="col">';
                          echo $field['label'];
                        echo '</th>';
                        }
                      }
                    }
                  ?>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($rows as $row) {
                    echo '<tr>';
                    foreach ($fields as $field) {
                      if (!isset($field['hideInList']) || !$field['hideInList']) {
                        if ($field['name'] === 'id') {
                          echo '<th scope="row">';
                            echo $row['id'];
                          echo '</th>';
                        } else {
                          echo '<td>';
                          switch ($field['type']) {
                            case "text" : {
                              echo $row[$field['name']];
                              break;
                            }
                            case "image" : {
                              echo '<img style="height: 30px;" src="/assets/images/cards/'.$row[$field['name']].'">';
                              break;
                            }
                            case "file" : {
                              echo $row[$field['name']];
                              break;
                            }
                            case "checkbox" : {
                              if ($row[$field['name']]) {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check" viewBox="0 0 16 16">
                                  <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                                </svg>';
                              }
                              break;
                            }
                            case "email" : {
                              echo $row[$field['name']];
                              break;
                            }
                            case "textarea" : {
                              echo $row[$field['name']];
                              break;
                            }
                            case "date" : {
                              echo $row[$field['name']];
                              break;
                            }
                            case "select" : {
                              echo $field['value'][$row[$field['name']]];
                              break;
                            }
                            case "multiSelect" : {
                              echo count($row[$field['name']]);
                              break;
                            }
                          }
                          echo '</td>';
                        }
                      }
                    }
                    echo "<th scope='col' class='micro-th'>";
                      require 'deleteButton.php';
                    echo "</th>";
                    echo "<th scope='col' class='micro-th'>";
                      require 'updateButton.php';
                    echo "</th>";
                    echo '</tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
