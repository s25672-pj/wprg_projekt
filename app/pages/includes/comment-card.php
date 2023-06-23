<div style="text-align: center;"><div class="col-md-6">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <h3 class="mb-0"><?=esc($row['username'])?></h3>
            <div class="mb-1 text-body-secondary"><?=date("jS M, Y",strtotime($row['date']))?></div>
            <p class="card-text mb-auto"><?=substr($row['comment'],0)?></p>

        </div>
        <div class="col-lg-auto col-12 d-lg-block">
        </div>
    </div>
</div>
</div>