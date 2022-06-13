<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $id_parent
 * @property string $menu_code
 * @property string $menu_name
 * @property int $menu_order
 * @property bool $is_displayed
 * @property string $icon
 * @property string|null $router_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Menu|null $parentMenu
 * @property-read \Illuminate\Database\Eloquent\Collection|Menu[] $subMenus
 * @property-read int|null $sub_menus_count
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIdParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereIsDisplayed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenuCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenuName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereMenuOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereRouterTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    public $table = 'menus';
    use HasFactory;

    public function subMenus(){
        return $this->hasMany(Menu::class, 'id_parent', 'id');
    }

    public function parentMenu(){
        return $this->belongsTo(Menu::class, 'id_parent', 'id');
    }
}
