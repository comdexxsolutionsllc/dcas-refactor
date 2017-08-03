<?php

namespace App;

use Cmgmyr\Messenger\Traits\Messagable;
use Cog\Ban\Contracts\HasBans as HasBansContract;
use Cog\Ban\Traits\HasBans;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Venturecraft\Revisionable\Revisionable;
use Venturecraft\Revisionable\RevisionableTrait;
use Watson\Rememberable\Rememberable;


abstract class BaseModel extends Revisionable implements AuditableContract, HasBansContract
{
    use Auditable,
        HasBans,
        Messagable,
        Notifiable,
        Rememberable,
        RevisionableTrait,
        SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
    ];

    /**
     * @var
     */
    protected $rememberFor;

    /**
     * @var bool
     * TODO: Fix duplication of 'created' event
     */
    protected $revisionEnabled = false;

    /**
     * @var int
     */
    protected $historyLimit = 1000;

    /**
     * @var bool
     */
    protected $revisionCleanup = true;

    /**
     * @var bool
     */
    protected $revisionCreationsEnabled = true;

    /**
     * @var string
     */
    protected $revisionNullString = 'nothing';

    /**
     * @var string
     */
    protected $revisionUnknownString = 'unknown';

    public static function boot()
    {
        parent::boot();
    }

    /**
     * Utility function to return last row of database.
     *
     * @return mixed
     */
    protected function last()
    {
        return $this::orderBy('created_at', 'desc')->first();
    }
}