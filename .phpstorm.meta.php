<?php

namespace PHPSTORM_META
{
    override(\Psr\Container\ContainerInterface::get(0), map(['' => '@']));
    override(\SocialBrothers\Cookie\Container\PluginContainer::get(0), map(['' => '@']));
    override(\SocialBrothers\Theme\Helpers\service(0), map(['' => '@']));
}
