<?php namespace Visiosoft\PuredashTheme\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event\SortNavigation;

class ApplySorting
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * The preferences repository.
     *
     * @var PreferenceRepositoryInterface $preferences
     */
    protected $preferences;

    /**
     * Create a new ApplySorting instance.
     *
     * @param SettingRepositoryInterface    $settings
     * @param PreferenceRepositoryInterface $preferences
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings    = $settings;
    }

    /**
     * Handle the event.
     *
     * @param SortNavigation $event
     */
    public function handle(SortNavigation $event)
    {
        $builder    = $event->getBuilder();
        $navigation = $builder->getNavigation();

        if ($settings = $this->settings->value('visiosoft.theme.puredash::navigation')) {
            $navigation = array_merge(array_flip((array)json_decode($settings)), $navigation);
        }



        /**
         * Remove non-installed addons
         * cause they won't be in the nav.
         */
        $navigation = array_filter(
            $navigation,
            function ($item) {
                return is_array($item);
            }
        );

        $builder->setNavigation($navigation);
    }
}
