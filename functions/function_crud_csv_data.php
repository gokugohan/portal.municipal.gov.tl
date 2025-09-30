<?php

add_action('wp_ajax_fetch_dashboard_map_data_list', 'fetch_dashboard_map_data_list');
add_action('wp_ajax_nopriv_fetch_dashboard_map_data_list', 'fetch_dashboard_map_data_list');
function fetch_dashboard_map_data_list()
{

    global $wpdb;
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $results = $wpdb->get_results("SELECT id,title,year,path FROM $table_name
ORDER BY year;");
    $data = [];

    foreach ($results as $d) {
        $data[] = [
            $d->title,
            $d->year,
            $d->path
        ];
    }

    return wp_send_json_success($data);
}

add_action('wp_ajax_fetch_population_by_year', 'fetch_population_by_year');
add_action('wp_ajax_nopriv_fetch_population_by_year', 'fetch_population_by_year');
function fetch_population_by_year()
{

    global $wpdb;
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $year = isset($_POST["year"]) ? strip_tags($_POST["year"]) : null;

    if (!$year) {
        wp_send_json_error(["message" => "Year is required"]);
    }

    $result = $wpdb->get_row("SELECT id,title,year,path FROM $table_name where year = $year");

    if (!$result || empty($result->path)) {
        wp_send_json_error(["message" => "No data found for year: $year"]);
    }

    $csv_url = $result->path;
    $csv_content = file_get_contents($csv_url);
    if ($csv_content === false) {
        wp_send_json_error(["message" => "Unable to read data"]);
    }

    // Convert entire CSV content to UTF-8 first
    $csv_content = mb_convert_encoding($csv_content, 'UTF-8', 'auto');

    // Parse CSV
    $rows = array_map("str_getcsv", explode("\n", trim($csv_content)));

    // Assume first row is headers
    $headers = array_map("trim", $rows[0]);
    unset($rows[0]);

    $data = [];
    foreach ($rows as $row) {
        if (count($row) < count($headers)) continue; // skip incomplete rows
        //        $row = array_map("trim", $row);
        $row = array_map(function ($value) {
            return trim(mb_convert_encoding($value, 'UTF-8', 'auto'));
        }, $row);

        //        // Convert each cell to UTF-8 and trim
        //        $row = array_map(function($value) {
        //            return trim(mb_convert_encoding($value, 'UTF-8', 'auto'));
        //        }, $row);

        $item = array_combine($headers, $row);

        $data[] = [
            "naran" => $item["MUNISIPIU"],
            "data"  => [
                "populasaun"            => $item["TOTAL POPULASAUN"],
                "mane"                  => $item["MANE"],
                "feto"                  => $item["FETO"],
                "umakain"               => $item["TOTAL UMA KAIN"],
                "postu_administrativu"  => $item["TOTAL POSTO"],
                "suku"                  => $item["TOTAL SUKU"],
                "aldeia"                => $item["TOTAL ALDEIA"],
            ]
        ];
    }
    header('Content-Type: application/json; charset=UTF-8');
    wp_send_json_success($data);
}


add_action('wp_ajax_fetch_dashboard_map_data', 'fetch_dashboard_map_data');

function fetch_dashboard_map_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . "dashboard_map_data";
    $results = $wpdb->get_results("SELECT id,title,year,path,created_at FROM $table_name");

?>
    <table class="table table-striped" id="table-dashboard-map-data">

        <thead>
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($results) > 0) {
                foreach ($results as $value) {

            ?>
                    <tr>
                        <td><?= $value->title; ?></td>
                        <td><?= $value->year; ?></td>
                        <td>
                            <?php
                            if ($value->path) {
                            ?>
                                <p>Current File: <a href="<?php echo esc_url($value->path); ?>" target="_blank">View</a></p>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn-edit-data btn btn-sm btn-info" href="#!"
                                    data-id="<?= $value->id; ?>"
                                    data-title="<?= $value->title; ?>"
                                    data-year="<?= $value->year; ?>"
                                    data-path="<?= $value->path; ?>">Edit</a> <a
                                    href="#!"
                                    data-id="<?= $value->id; ?>"
                                    data-title="<?= $value->title; ?>"
                                    class="btn-delete-data btn btn-sm btn-danger">Delete</a>
                            </div>

                        </td>
                    </tr>
            <?php
                }
            }

            ?>
        </tbody>
    </table>

<?php
    die();
}


add_action('wp_ajax_add_or_update_dashboard_map_data', 'add_or_update_dashboard_map_data');
//add_action('wp_ajax_nopriv_add_or_update_dashboard_map_data', 'add_or_update_dashboard_map_data');

function add_or_update_dashboard_map_data()
{
    $data["title"] = isset($_POST["title"]) ? strip_tags($_POST["title"]) : null;
    $data["year"] = isset($_POST["year"]) ? strip_tags($_POST["year"]) : null;
    $data["path"] = isset($_POST["path"]) ? strip_tags($_POST["path"]) : null;

    switch ($_POST["is_update"]) {
        case 0:
            dashboard_map_create($data);
            break;
        case 1:
            $data["id"] = isset($_POST["id"]) ? strip_tags($_POST["id"]) : "";
            dashboard_map_update($data);
    }
}

add_action('wp_ajax_delete_dashboard_map_data', 'delete_dashboard_map_data');
//add_action('wp_ajax_nopriv_delete_dashboard_map_data', 'delete_dashboard_map_data');

function delete_dashboard_map_data()
{
    if (isset($_POST["id"])) {
        dashboard_map_delete($_POST["id"]);
    }
}
