<?php


use App\Repositories\TranslationRepo;
use Tests\TestCase;

class TranslationControllerTest extends TestCase
{

    /**
     * @var TranslationRepo
     */
    private $translationRepo;

    /**
     * @var Mockery\MockInterface
     */
    private $translationRepoMock;

    /**
     * TranslationRepo Success Response Example
     * @var array
     */
    private $translationRepoSuccessResponse = ['translation' => 'Hello World'];

    /**
     * TranslationRepo Mock initialization
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->translationRepoMock = Mockery::mock(TranslationRepo::class);
        $this->app->instance(TranslationRepo::class, $this->translationRepoMock);
        $this->translationRepo = $this->app->make(TranslationRepo::class);
    }


    /**
     * Translate endpoint test success case
     * @return void
     */
    public function testTranslateSuccess(): void
    {
        $this->translationRepoMock
            ->shouldReceive('translate')
            ->once()
            ->with('Привет Мир')
            ->andReturn($this->translationRepoSuccessResponse);
        $response = $this->post('/api/translate', ['text' => 'Привет Мир']);

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
            'error' => '',
            'translation' => 'Hello World'
        ]);
    }

    /**
     * Translate endpoint test success case
     * @return void
     */
    public function testTranslateError(): void
    {
        $response = $this->post('/api/translate', []);
        $response->assertStatus(422);
        $response->assertJson([
            'error' => 'The text field is required.'
        ]);
    }
}
