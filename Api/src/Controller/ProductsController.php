<?php
namespace App\Controller;
  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

  class ProductsController extends AbstractController
  {
    public function products(): JsonResponse {
      $number = random_int(0, 100);
      $data = [
        [
          'id' => 1,
          'title' => 'BANGE New Business Backpack Men’s USB Anti-Theft Computer Bag',
          'price' => 109.95,
          'description' => 'BANGE New Business Backpack Men’s USB Anti-Theft Computer Bag Big Capacity Laptop Backpack',
          'category' => 'men’s clothing',
          'image' => 'https://storeapi.khrov.com/images/backpack.jpeg',
          'rating' => [
            'rate' => 3.9,
            'count' => 120
          ]
        ],
        [
          'id' => 2,
          'title' => 'British Coat',
          'price' => 80.95,
          'description' => 'Charisma and style are clearly defined by a British Coat. This coat is the crossover between a jacket and a coat. A coat suitable for each season of the year.',
          'category' => 'men’s clothing',
          'image' => 'https://storeapi.khrov.com/images/british_coat.jpg',
          'rating' => [
            'rate' => 4.9,
            'count' => 40
          ]
        ],
        [
          'id' => 3,
          'title' => 'FrostFlieger - Wintersport Bomberjacke',
          'price' => 65,
          'description' => 'Aktualisieren Sie Ihre Wintermode mit unseren atemberaubenden FrostFlieger - Wintersport Bomberjacke.',
          'category' => 'men’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Bomberjacke.jpeg',
          'rating' => [
            'rate' => 4.1,
            'count' => 10
          ]
        ],
        [
          'id' => 4,
          'title' => 'D1fference Sportwinterjacke',
          'price' => 49.95,
          'description' => 'great outerwear jackets for Spring/Autumn/Winter, suitable for many occasions, such as working, hiking, camping, mountain/rock climbing, cycling, traveling or other outdoors. Good gift choice for you or your family member. A warm hearted love to Father, husband or son in this thanksgiving or Christmas Day.',
          'category' => 'men’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Puffer.jpeg',
          'rating' => [
            'rate' => 3.1,
            'count' => 43
          ]
        ],
        [
          'id' => 5,
          'title' => 'Ridge Beveled Ring',
          'price' => 300.95,
          'description' => 'The Ridge Beveled Ring Set is purpose-built for every occasion. Silicone for comfort & flexibility; beveled metal for a sharp & rugged look. Strong, durable, and scratch-resistant.',
          'category' => 'Jewelry',
          'image' => 'https://storeapi.khrov.com/images/ridgeRing.jpeg',
          'rating' => [
            'rate' => 4.2,
            'count' => 680
          ]
        ],
        [
          'id' => 6,
          'title' => 'BOXED CLEAN CUBANA CHAIN',
          'price' => 140.00,
          'description' => 'Always. A perfect pick. A modern twist to the iconic cuban bracelet. Hand-finished details and easy clip on clasp.',
          'category' => 'Jewelry',
          'image' => 'https://storeapi.khrov.com/images/cubanaChain.jpeg',
          'rating' => [
            'rate' => 3.9,
            'count' => 120
          ]
        ],
        [
          'id' => 7,
          'title' => 'Blauer Saphir-Tropfen-Anhänger mit Diamant',
          'price' => 145.95,
          'description' => 'Dieser klassische Solitäranhänger verfügt über einen birnenförmigen Saphir, der in einer Krappenfassung befestigt ist. Auf dem blauen Edelstein sitzt ein brillanter runder Diamant, der dem Design noch mehr Charme verleiht. Schlicht und doch ansprechend: Dieser Saphir-Anhänger aus 9-karätigem Gelbgold ist mit einem glänzenden V-Ballen gefertigt',
          'category' => 'Jewelry',
          'image' => 'https://storeapi.khrov.com/images/Saphir.jpeg',
          'rating' => [
            'rate' => 5.0,
            'count' => 2
          ]
        ],
        [
          'id' => 8,
          'title' => 'Watch Ring Two-Hand Gold-Tone Stainless Steel',
          'price' => 95.95,
          'description' => 'It’s a watch. It’s a ring. It’s going to be your new favorite piece. Featuring a genuine malachite dial, easy-read indices and a flexible band to fit any finger, good things really do come in small packages.',
          'category' => 'Jewelry',
          'image' => 'https://storeapi.khrov.com/images/watch.jpeg',
          'rating' => [
            'rate' => 4.4,
            'count' => 13
          ]
        ],
        [
          'id' => 9,
          'title' => 'EcoFlow DELTA Pro Portable Power Station mit 4500 Watt',
          'price' => 45.95,
          'description' => 'DELTA Pro wurde in der Kategorie Produktdesign 2022 mit dem Red Dot Award ausgezeichnet. Dieser zählt zu den größten Designwettbewerben weltweit und hat sich international als eines der begehrtesten Qualitätssiegel für gute Gestaltung etabliert. Das DELTA Pro bietet eine Kapazität von 3,6 kWh, die auf bis zu 25 kWh erweitert werden kann. ',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/RedDot_Award_2022.jpg',
          'rating' => [
            'rate' => 3.9,
            'count' => 120
          ]
        ],
        [
          'id' => 10,
          'title' => 'Goal Zero 12V KFZ Ladekabel für YETI Power Station & Sherpa',
          'price' => 105.95,
          'description' => 'Dient zum sicheren und effizienten Laden eines Goal Zero Yeti-Lithiums oder einer Bleisäure aus einer 12-V-Quelle mit einem vom Benutzer austauschbaren 15A-Schutz',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/goalzero.jpg',
          'rating' => [
            'rate' => 3.8,
            'count' => 10
          ]
        ],
        [
          'id' => 11,
          'title' => 'Goal Zero Lighthouse Core',
          'price' => 90.5,
          'description' => 'Eine gute Laterne sollte nicht kompliziert sein. Die Lighthouse Core wiederaufladbare USB-Laterne verfügt über 430 Lumen, Helligkeitszifferblatt, langlebigen Akku und USB-Ausgang.',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/lighthouse.jpg',
          'rating' => [
            'rate' => 3.2,
            'count' => 30
          ]
        ],
        [
          'id' => 12,
          'title' => 'Micro Flash mit USB Powerbank',
          'price' => 108.98,
          'description' => 'Diese kleine wiederaufladbare USB-Laterne ist eine All-in-One-Lösung für unterwegs, perfekt für die Geldbörse oder den Rucksack.',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/microflash.jpg',
          'rating' => [
            'rate' => 3.4,
            'count' => 1
          ]
        ],
        [
          'id' => 13,
          'title' => 'USB zu Micro Kabel 25 cm',
          'price' => 55.95,
          'description' => '25 cm USB-zu-Micro-Anschlusskabel - perfekt für Sie wenn Sie mittellange Ladekabel benötigen. Sehr robust und langlebig durch Hochwertige Materialien. Zum laden oder synchronisieren von Handy oder Tablets.',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/Kabel.jpg',
          'rating' => [
            'rate' => 3.5,
            'count' => 13
          ]
        ],
        [
          'id' => 14,
          'title' => 'EcoFlow MC4 zu XT60 Solar Kabel - 5m',
          'price' => 19.95,
          'description' => 'Das EcoFlow MC4 zu XT60 Kable (5m) ermöglicht den Anschluss einer tragbaren EcoFlow Powerstation (DELTA / RIVER) an ein Solarmodul mit Standard-MC4-Ausgang.',
          'category' => 'electronics',
          'image' => 'https://storeapi.khrov.com/images/Solar_Kabel.jpg',
          'rating' => [
            'rate' => 4.9,
            'count' => 1
          ]
        ],
        [
          'id' => 15,
          'title' => 'Tankkleid Mit Sternendruck, Lässiges, Ärmelloses, Figurbetontes Hüftkleid',
          'price' => 35.95,
          'description' => 'Tankkleid Mit Sternendruck, Lässiges, Ärmelloses, Figurbetontes Hüftkleid Mit Rundhalsausschnitt, Damenbekleidung',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/kleidung.jpg',
          'rating' => [
            'rate' => 3.0,
            'count' => 19
          ]
        ],
        [
          'id' => 16,
          'title' => 'Damen Kleid-Set Zweiteiliges Kleid Blumenkleid Midikleid Purpur 3/4 Ärmel Bedruckt',
          'price' => 18.95,
          'description' => 'Zweiteiliges langes Kleid mit Druckmuster: Das erste Kleidungsstück ist ein ärmelloses bedrucktes Kleid und das zweite Kleidungsstück ist ein elegantes Kleid mit halben Ärmeln.',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/clothing.jpg',
          'rating' => [
            'rate' => 4.9,
            'count' => 149
          ]
        ],
        [
          'id' => 17,
          'title' => 'Kirche Kleid Midikleid Schwarz Rosa Wein',
          'price' => 10.15,
          'description' => 'Damen Arbeitskleidung Etuikleid Kirche Kleid Midikleid Schwarz Rosa Wein Halbe Ärmel Blumen gefälschtes zweiteiliges Sommer Frühling V Ausschnitt Elegant B¨¹ro kleid hochzeitsgast Sommerkleid 2023',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Arbeitskleidung.jpg',
          'rating' => [
            'rate' => 3.9,
            'count' => 125
          ]
        ],
        [
          'id' => 18,
          'title' => 'Midikleid Marineblau Kurzarm Blumen Bedruckt Sommer Frühling',
          'price' => 45.95,
          'description' => 'Damen Casual kleid Etuikleid Midikleid Marineblau Kurzarm Blumen Bedruckt Sommer Frühling Gezackter Hals Urlaub 2023 S M L XL XXL 3XL',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Urlaub.jpg',
          'rating' => [
            'rate' => 3.8,
            'count' => 15
          ]
        ],
        [
          'id' => 19,
          'title' => 'Midikleid Weiß Blau Grün Kurzarm Blume Bedruckt Sommer',
          'price' => 24.95,
          'description' => 'Damen Casual kleid Etuikleid Midikleid Weiß Blau Grün Kurzarm Blume Bedruckt Sommer Frühling V Ausschnitt Basic Urlaub Sommerkleid 2023 S M L XL XXL 3XL',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Etuikleid.jpg',
          'rating' => [
            'rate' => 4.1,
            'count' => 139
          ]
        ],
        [
          'id' => 20,
          'title' => 'Casual kleid Etuikleid Midikleid Weiß Grün Grau Kurzarm',
          'price' => 19.95,
          'description' => 'Damen Casual kleid Etuikleid Midikleid Weiß Grün Grau Kurzarm Blume Bedruckt Frühling Sommer V Ausschnitt Basic Täglich Urlaub Wochenende 2023 S M L XL XXL XXXL',
          'category' => 'women’s clothing',
          'image' => 'https://storeapi.khrov.com/images/Midikleid.jpg',
          'rating' => [
            'rate' => 3.7,
            'count' => 9
          ]
        ],
      ];
      $stri = json_encode($data);
      return JsonResponse::fromJsonString($stri, 200);
    }
  }
  
?>
