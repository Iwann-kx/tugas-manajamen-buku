<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_guests_are_redirected_and_logout_removes_access_to_books(): void
    {
        $this->get(route('books.index'))->assertRedirect(route('login'));

        $user = $this->userWithRole('Mahasiswa');
        $this->actingAs($user)->post(route('logout'))->assertRedirect('/');
        $this->assertGuest();
        $this->get(route('books.index'))->assertRedirect(route('login'));
    }

    public function test_students_can_view_books_but_cannot_change_them_even_by_url(): void
    {
        $student = $this->userWithRole('Mahasiswa');
        $book = $this->makeBook();

        $this->actingAs($student)
            ->get(route('books.index'))
            ->assertOk();
        $this->get(route('books.show', $book))->assertOk();
        $this->get(route('books.create'))->assertForbidden();
        $this->post(route('books.store'), $this->bookData())->assertForbidden();
        $this->get(route('books.edit', $book))->assertForbidden();
        $this->put(route('books.update', $book), $this->bookData())->assertForbidden();
        $this->delete(route('books.destroy', $book))->assertForbidden();

        $this->assertDatabaseHas('books', ['id' => $book->id]);
    }

    public function test_lecturers_can_create_and_edit_but_cannot_delete_books(): void
    {
        $lecturer = $this->userWithRole('Dosen');
        $book = $this->makeBook();
        $this->actingAs($lecturer);

        $this->get(route('books.create'))->assertOk();
        $this->post(route('books.store'), $this->bookData())
            ->assertRedirect(route('books.index'));
        $createdBook = Book::query()->where('judul', 'Buku Baru')->firstOrFail();

        $this->get(route('books.edit', $book))->assertOk();
        $this->put(route('books.update', $book), $this->bookData(['judul' => 'Judul Diperbarui']))
            ->assertRedirect(route('books.index'));
        $this->assertSame('Judul Diperbarui', $book->fresh()->judul);
        $this->delete(route('books.destroy', $createdBook))->assertForbidden();
        $this->assertDatabaseHas('books', ['id' => $createdBook->id]);
    }

    public function test_admin_can_delete_books_and_manage_user_roles(): void
    {
        $admin = $this->userWithRole('Admin');
        $student = $this->userWithRole('Mahasiswa');
        $book = $this->makeBook();

        $this->actingAs($admin)
            ->delete(route('books.destroy', $book))
            ->assertRedirect(route('books.index'));

        $this->get(route('users.roles.index'))->assertOk();
        $this->patch(route('users.roles.update', $student), ['role' => 'Dosen'])
            ->assertRedirect(route('users.roles.index'));
        $this->assertTrue($student->fresh()->hasRole('Dosen'));
    }

    public function test_non_admin_cannot_manage_user_roles(): void
    {
        $lecturer = $this->userWithRole('Dosen');
        $student = $this->userWithRole('Mahasiswa');

        $this->actingAs($lecturer)
            ->get(route('users.roles.index'))
            ->assertForbidden();
        $this->patch(route('users.roles.update', $student), ['role' => 'Admin'])
            ->assertForbidden();
    }

    private function userWithRole(string $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    private function makeBook(): Book
    {
        return Book::create($this->bookData());
    }

    /**
     * @param  array<string, mixed>  $overrides
     * @return array{judul: string, penulis: string, penerbit: string, tahun_terbit: int, deskripsi: string}
     */
    private function bookData(array $overrides = []): array
    {
        return array_merge([
            'judul' => 'Buku Baru',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2020,
            'deskripsi' => 'Deskripsi buku',
        ], $overrides);
    }
}
