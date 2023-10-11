<?php

namespace App\Services\AppointmentService;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppointmentService implements IAppointmentService, \App\Services\BaseService\IBaseService
{
    private $model;

    public function create(array $data)
    {
        try {
            DB::transaction(function() use($data){
                $this->model = Appointment::create($data);
            });
            return $this->model;
        } catch (QueryException $e) {
            Log::info($e->getMessage());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        return false;
    }

    public function update(array $data, int $id): bool
    {
        try {
            DB::transaction(function() use($data, $id){
                $this->model = Appointment::find($id);
                $this->model->update($data);
            });
            return $this->model;
        } catch (QueryException $e) {
            Log::info($e->getMessage());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        return false;
    }

    public function delete(int $id)
    {
        try {
            DB::transaction(function() use($id){
                $this->model = Appointment::find($id);
                $this->model->delete();
            });
            return true;
        } catch (QueryException $e) {
            Log::info($e->getMessage());
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
        return false;
    }

    public function get(int $id)
    {
        return Appointment::find($id);
    }

    public function all()
    {
        return Appointment::all();
    }

    public function paginate(int $page)
    {
        return Appointment::orderBy('id', 'desc')->paginate($page);
    }

    public function assignProduct($appointment_id, $product_id)
    {
        $appointment = Appointment::find($appointment_id);
        $appointment->products()->attach($product_id);
    }

    public function reportByDate($start_date, $end_date)
    {
        return $this->searchByDate($start_date, $end_date);
    }

    public function searchByDate(string $start_date, string $end_date)
    {
        $appointments = Appointment::whereBetween('day', [$start_date, $end_date])->orderBy('id', 'desc')->get();
        return $appointments;
    }

    public function getForProducts()
    {
        return Appointment::has('products')->paginate(10);
    }

    public function getForQuotations()
    {
        return Appointment::has('quotations')->paginate(10);
    }
}
