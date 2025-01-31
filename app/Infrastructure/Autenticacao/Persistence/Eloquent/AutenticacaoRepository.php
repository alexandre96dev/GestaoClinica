<?php
    namespace App\Infrastructure\Autenticacao\Persistence\Eloquent;

    use App\Domains\Autenticacao\Entity\Usuario;
    use App\Domains\Autenticacao\Repository\AutenticacaoRepositoryInterface;
    use App\Models\User as UsuarioModel;

    class AutenticacaoRepository implements AutenticacaoRepositoryInterface
    {
        public function listarUsuarioPorEmail(string $email): ?Usuario
        {
            $usuarioModel = UsuarioModel::where('email', $email)->first();

            if (!$usuarioModel) {
                return null;
            }
            
            return new Usuario(
                $usuarioModel->id,
                $usuarioModel->email,
                $usuarioModel->password
            );
            
        }
    }