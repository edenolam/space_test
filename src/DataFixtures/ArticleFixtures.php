<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Tag;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;

class ArticleFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static array $articleTitles = [
        'Why Asteroids Taste Like Bacon',
        'Life on Planet Mercury: Tan, Relaxing and Fabulous',
        'Light Speed Travel: Fountain of Youth or Fallacy',
        'PHP 8.0'
    ];
    private static array $articleImages = [
        'asteroid.jpeg',
        'mercury.jpeg',
        'lightspeed.png',
    ];
    private static array $articleAuthors = [
        'Mike Ferengi',
        'Amy Oort',
    ];

    private static array $articleContent = [
        "beaucoup de nouvelles **fonctionnalités** et **d'optimisations**, incluant :
les arguments nommés,
les types d'union,
attributs,
promotion de propriété de constructeur,
l'expression match,
l'opérateur nullsafe,
**JIT (Compilation à la Volée)**,
améliorations dans le système de typage, la gestion d'erreur, et de cohérence.
"
    ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Article::class, 10, function (Article $article, $count) use ($manager) {
            $article
                ->setTitle($this->faker->randomElement(self::$articleTitles))
                ->setAuthor($this->faker->randomElement(self::$articleAuthors))
                ->setHeartCount($this->faker->numberBetween(5, 100))
                ->setSlug($this->faker->slug)
                ->setImageFilename($this->faker->randomElement(self::$articleImages))
                ->setContent($this->faker->randomElement(self::$articleContent));
            // publish most articles
            if ($this->faker->boolean(70)) {
                $article->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }


            $tags = $this->getRandomReferences(Tag::class, $this->faker->numberBetween(0, 5));
            foreach ($tags as $tag) {
                $article->addTag($tag);
            }
        });
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            TagFixtures::class
        ];
    }
}
