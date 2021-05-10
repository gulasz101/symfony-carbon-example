<?php

declare(strict_types=1);

//config for 9+
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
	$parameters = $containerConfigurator->parameters();
	$parameters->set(
		Option::PATHS,
		[
			__DIR__ . '/src',
			__DIR__ . '/tests',
			__DIR__ . '/ecs.php',
			//			__DIR__ . '/rector.php',
		]
	);

	$parameters->set(
		Option::SETS,
		[
			SetList::SPACES,
			SetList::CLEAN_CODE,
			SetList::ARRAY,
			SetList::COMMENTS,
			SetList::STRICT,
			SetList::NAMESPACES,
			SetList::CONTROL_STRUCTURES,
			SetList::PSR_12,
		]
	);
	// indent and tabs/spaces
	// [default: spaces]
	$parameters->set(Option::INDENTATION, 'tab');

	// [default: PHP_EOL]; other options: "\n"
	// $parameters->set(Option::LINE_ENDING, "\r\n");
};
