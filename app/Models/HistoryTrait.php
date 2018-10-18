<?php

namespace App\Models;
use \Venturecraft\Revisionable\RevisionableTrait;
use Carbon\Carbon;

trait HistoryTrait
{
	use RevisionableTrait;
    protected $revisionCreationsEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 2;

    public function createdBy() {
    	if ($this->revisionHistory) {
    		foreach ($this->revisionHistory as $history) {
    			if ($history->key == 'created_at' && !$history->old_value) {
    				$data = $history->userResponsible();
                    $data['time'] = Carbon::createFromFormat('Y-m-d H:i:s', $history->created_at)->format('H:i:s - d/m/Y');
                    return $data;
    			}
    		}
    	}
    	return '';
    }

    public function updatedBy() {
    	if ($this->revisionHistory) {
    		foreach ($this->revisionHistory->reverse() as $history) {
    			if ($history->key != 'created_at') {
    				$data = $history->userResponsible();
                    $data['time'] = Carbon::createFromFormat('Y-m-d H:i:s', $history->updated_at)->format('H:i:s - d/m/Y');
                    return $data;
    			}
    		}
    	}
    	return '';
    }
}