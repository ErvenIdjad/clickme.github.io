<div class="modal fade" id="achievModal" tabindex="-1" aria-labelledby="achievModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="achievModal">Achivements</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="click-count-section">
                    <div class="click-count">
                        <h2>Total Clicks: <?php echo $current_click_count; ?></h2>
                    </div><div class="click-count">
                        <h2>Global Ranking: <?php echo $rank; ?></h2>
                    </div>
                    <div class="level">
                        <h2>Level:
                            <?php
            $levels = array(
                "1" => "Newcomer",
                "100" => "Novice Clicker",
                "1000" => "Expert Clicker",
                "10000" => "Master Clicker",
            );
            foreach ($levels as $click_count => $level) {
                if ($current_click_count >= $click_count) {
                    echo $level;
                } else {
                    break;
                }
            }
            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>