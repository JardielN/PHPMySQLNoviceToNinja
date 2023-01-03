<?php



class SingerController
{
    private $singersTable;
    private $authorsTable;

    public function __construct(DatabaseTable $singersTable, DatabaseTable $authorsTable)
    {
        $this->singersTable = $singersTable;
        $this->authorsTable = $authorsTable;
    }

    public function list()
    {
        $result = $this->singersTable->findAll();
        $singers = [];
        foreach ($result as $singer) {
            $author = $this->authorsTable->findById($singer['idauthors']);
            $singers[] = [
                'idsingers' => $singer['idsingers'],
                'singer_name' => $singer['singer_name'],
                'date_added' => $singer['date_added'],
                'name_author' => $author['name_author'],
                'email_author' => $author['email_author']
            ];
        }
        $title = 'Singer List';
        $totalSingers = $this->singersTable->total();
        return [
            'template' => 'singers.html.php', 'title' => $title,
            'variables' => [
                'totalSingers' => $totalSingers,
                'singers' => $singers
            ]
        ];
    }

    public function home()
    {
        $title = 'Singers and Albums Database';
        return ['template' => 'home.html.php', 'title' => $title];
    }

    public function delete()
    {
        $this->singersTable->delete($_POST['idsingers']);

        header('location: /singer/list');
    }

    public function edit()
    {
        if (isset($_POST['singer'])) {
            $singer = $_POST['singer'];
            $singer['date_added'] = new DateTime();
            $singer['idauthors'] = 4;
            $singer['idcategories'] = 3;
            $this->singersTable->save($singer);
            header('location: /singer/list');
        } else {
            if (isset($_GET['idsingers'])) {
                $singer = $this->singersTable->findById($_GET['idsingers']);
            }
            $title = 'Edit Singer';

            return [
                'template' => 'editsinger.html.php', 'title' => $title,
                'variables' => [
                    'singer' => $singer ?? null
                ]
            ];
        }
    }
}
