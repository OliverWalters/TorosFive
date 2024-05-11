<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Entrenador
 *
 * @ORM\Table(name="entrenador")
 * @ORM\Entity
 */
class Entrenador
{
    /**
     * @var string
     *
     * @ORM\Column(name="dniEntrenador", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dnientrenador;

    /**
     * @var string|null
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usuario", type="string", length=50, nullable=true)
     */
    private $usuario;

    /**
     * @var string|null
     *
     * @ORM\Column(name="clave", type="string", length=255, nullable=true)
     */
    private $clave;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="nacimiento", type="date", nullable=true)
     */
    private $nacimiento;

    public function getDnientrenador(): string {
        return $this->dnientrenador;
    }

    public function getImagen(): ?string {
        return $this->imagen;
    }

    public function getUsuario(): ?string {
        return $this->usuario;
    }

    public function getClave(): ?string {
        return $this->clave;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function getNacimiento(): ?\DateTime {
        return $this->nacimiento;
    }

    public function setDnientrenador(string $dnientrenador): void {
        $this->dnientrenador = $dnientrenador;
    }

    public function setImagen(?string $imagen): void {
        $this->imagen = $imagen;
    }

    public function setUsuario(?string $usuario): void {
        $this->usuario = $usuario;
    }

    public function setClave(?string $clave): void {
        $this->clave = $clave;
    }

    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setNacimiento(?\DateTime $nacimiento): void {
        $this->nacimiento = $nacimiento;
    }

    public function __toString(): string
    {
        return $this->nombre;
    }

}
