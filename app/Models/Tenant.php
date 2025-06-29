<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'id',
        'name',
        'email',
        'logo_path_1',
        'logo_path_2',
        'favicon_path',
        'banner_path',
        'services_path_1',
        'services_path_2',
        'services_path_3',
        'about_path',
        'button_banner_color',
        'button_banner_text_color',
        'navbar_color_1',
        'navbar_color_2',
        'navbar_text_color_1',
        'navbar_text_color_2',
        'background_color_1',
        'background_color_2',
        'text_color_1',
        'text_color_2',
        'button_color_sidebar',
        'color_metrics',
        'color_tables',
        'heading_font',
        'body_font',
        'navbar_font',
        'contact_email',
        'contact_instagram',
        'contact_linkedin',
        'google_analytics_id',
        'openrouter_api_key',
    ];

    protected static function booted()
    {
        static::deleting(function ($tenant) {
            if ($tenant->logo_path_1 && file_exists(public_path($tenant->logo_path_1))) {
                unlink(public_path($tenant->logo_path_1));
            }

            if ($tenant->logo_path_2 && file_exists(public_path($tenant->logo_path_2))) {
                unlink(public_path($tenant->logo_path_2));
            }
        });
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'logo_path_1',
            'logo_path_2',
            'favicon_path',
            'banner_path',
            'services_path_1',
            'services_path_2',
            'services_path_3',
            'about_path',
            'button_banner_color',
            'button_banner_text_color',
            'navbar_color_1',
            'navbar_color_2',
            'navbar_text_color_1',
            'navbar_text_color_2',
            'background_color_1',
            'background_color_2',
            'text_color_1',
            'text_color_2',
            'button_color_sidebar',
            'color_metrics',
            'color_tables',
            'heading_font',
            'body_font',
            'navbar_font',
            'contact_email',
            'contact_instagram',
            'contact_linkedin',
            'google_analytics_id',
            'openrouter_api_key',
            'enabled',
        ];
    }

    public function pages()
    {
        return $this->hasMany(TenantPage::class);
    }

    public function settings()
    {
        return $this->hasMany(TenantSetting::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function texts()
    {
        return $this->hasMany(TenantText::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'tenant_id', 'id');
    }
    public function order()
    {
        return $this->hasOne(Order::class, 'tenant_id', 'id');
    }
    public function hasFeature($feature)
    {
        $plan = optional($this->order)->plan_name;

        $featuresByPlan = [
            'Básico' => ['pagina', 'agendamiento', 'clientes', 'pagos'],
            'Profesional' => ['pagina', 'agendamiento', 'clientes', 'pagos', 'archivos'],
            'Premium' => ['pagina', 'agendamiento', 'clientes', 'pagos', 'archivos', 'chatbot', 'soporte'],
        ];

        if (isset($featuresByPlan[$plan])) {
            return in_array($feature, $featuresByPlan[$plan]);
        }
 
        
        return true;
    }



}
