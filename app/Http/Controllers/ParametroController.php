<?php

namespace App\Http\Controllers;

use App\Models\Parametro; // Asegúrate de importar tu modelo Parametro
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Para registrar eventos si es necesario
use Exception; // Para manejar excepciones

class ParametroController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de los recursos (parámetros).
     */
    public function index()
    {
        try {
            // Obtener todos los parámetros de la base de datos
            // Puedes agregar paginación si tienes muchos parámetros: Parametro::paginate(10);
            $parametros = Parametro::all();

            // Retornar la vista 'parametros.index' y pasar los parámetros
            return view('Parametros.index', compact('parametros'));

        } catch (Exception $e) {
            // Registra el error para depuración
            Log::error('Error al obtener el listado de parámetros: ' . $e->getMessage());

            // Redirige con un mensaje de error genérico
            return redirect()->back()->with('error', 'Ocurrió un error al cargar los parámetros. Por favor, inténtelo de nuevo más tarde.');
        }
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear un nuevo recurso (parámetro).
     */
    public function create()
    {
        // Retornar la vista del formulario de creación
        return view('Parametros.create');
    }

    /**
     * Store a newly created resource in storage.
     * Guarda un recurso (parámetro) recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'id' => 'required|string|max:255|unique:parametros,id', // 'id' es la clave y debe ser único
            'valor' => 'nullable|string', // 'valor' puede ser cualquier texto o nulo
            'descripcion' => 'nullable|string|max:500', // 'descripcion' es opcional
        ], [
            'id.required' => 'La clave del parámetro es obligatoria.',
            'id.unique' => 'Ya existe un parámetro con esta clave.',
            'id.max' => 'La clave no puede exceder los 255 caracteres.',
            'valor.string' => 'El valor debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 500 caracteres.',
        ]);

        try {
            // Crear una nueva instancia del modelo Parametro
            $parametro = new Parametro();
            $parametro->id = $request->id; // Asigna el 'id' (clave) del request
            $parametro->valor = $request->valor; // Asigna el 'valor' del request
            $parametro->descripcion = $request->descripcion; // Asigna la 'descripcion' del request

            // Guardar el parámetro en la base de datos
            $parametro->save();

            // Redirigir a la vista index con un mensaje de éxito
            return redirect()->route('Parametros.index')->with('success', 'Parámetro creado exitosamente.');

        } catch (Exception $e) {
            // Registra el error
            Log::error('Error al guardar el parámetro: ' . $e->getMessage());

            // Redirige de vuelta al formulario con un mensaje de error
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al crear el parámetro. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Display the specified resource.
     * Muestra el recurso (parámetro) especificado.
     */
    public function show(Parametro $parametro) // Laravel automáticamente inyecta el modelo por el 'id'
    {
        // Retornar la vista 'parametros.show' y pasar el parámetro
        return view('Parametros.show', compact('parametro'));
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar el recurso (parámetro) especificado.
     */
    public function edit(Parametro $parametro) // Laravel automáticamente inyecta el modelo por el 'id'
    {
        // Retornar la vista 'parametros.edit' y pasar el parámetro
        return view('Parametros.edit', compact('parametro'));
    }

    /**
     * Update the specified resource in storage.
     * Actualiza el recurso (parámetro) especificado en la base de datos.
     */
    public function update(Request $request, Parametro $parametro) // Laravel inyecta el modelo existente
    {
        // Validar los datos de entrada
        $request->validate([
            // 'id' no se valida como único aquí porque es el que estamos actualizando.
            // Si permites cambiar el ID, necesitarías una validación más compleja (unique, ignorando el propio ID).
            'valor' => 'nullable|string',
            'descripcion' => 'nullable|string|max:500',
        ], [
            'valor.string' => 'El valor debe ser una cadena de texto.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 500 caracteres.',
        ]);

        try {
            // Actualizar los atributos del parámetro
            $parametro->valor = $request->valor;
            $parametro->descripcion = $request->descripcion;

            // Guardar los cambios en la base de datos
            $parametro->save();

            // Redirigir a la vista index con un mensaje de éxito
            return redirect()->route('Parametros.index')->with('success', 'Parámetro actualizado exitosamente.');

        } catch (Exception $e) {
            // Registra el error
            Log::error('Error al actualizar el parámetro ' . $parametro->id . ': ' . $e->getMessage());

            // Redirige de vuelta al formulario con un mensaje de error
            return redirect()->back()->withInput()->with('error', 'Ocurrió un error al actualizar el parámetro. Por favor, inténtelo de nuevo.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * Elimina el recurso (parámetro) especificado de la base de datos.
     * Este método NO ELIMINARÁ el parámetro, solo mostrará un mensaje de "Acción no permitida".
     */
    public function destroy(Parametro $parametro) // Laravel inyecta el modelo existente
    {
        // No se permite la eliminación de parámetros.
        // Registra el intento de eliminación si es necesario.
        Log::warning('Intento de eliminar el parámetro ' . $parametro->id . ' fue denegado. La eliminación de parámetros no está permitida.');

        // Redirigir con un mensaje de advertencia.
        // El SweetAlert2 ya maneja la parte visual en el frontend,
        // pero esta alerta de sesión es una capa de seguridad y retroalimentación en el backend.
        return redirect()->route('Parametros.index')->with('warning', 'La eliminación de parámetros no está permitida.');
    }
}
