<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use App\Exceptions\InputException;

class DashboardService{
    private DashboardRepository $repository;

    public function __construct(){
        $this->repository = new DashboardRepository();
    }

    public function statistics(){
        return [
            $this->repository->pendingReservations(),
            $this->repository->confirmedTodayReservations(),
            $this->repository->confirmedTmrwReservations(),
            $this->repository->pendingReservationsToday()
        ];
    }
}