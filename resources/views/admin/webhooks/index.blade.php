@extends('admin.layouts.app')
@section('title', 'Webhooks / Automatizaciones')

@section('content')
<div class="card-admin mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <div class="stat-icon me-3" style="background: rgba(67,56,202,0.1); color: #4338CA; width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-plug"></i>
            </div>
            <div>
                <h5 class="mb-0" style="font-weight: 700; color: #1E293B;">Webhooks para n8n / Automatización</h5>
                <p class="mb-0 text-muted" style="font-size: 13px;">Configura URLs de webhook para cada evento. Cuando ocurra el evento, se enviará un POST JSON con los datos.</p>
            </div>
        </div>

        <div class="alert" style="background: #EEF2FF; border: 1px solid #C7D2FE; border-radius: 10px; font-size: 13px; color: #4338CA;">
            <i class="fas fa-info-circle me-2"></i>
            <strong>¿Cómo funciona?</strong> Crea un nodo <strong>Webhook</strong> en n8n, copia la URL de producción y pégala aquí. Activa el switch para habilitar el envío automático.
            El payload incluye: <code>evento</code>, <code>timestamp</code> y <code>data</code> con los campos del formulario.
        </div>
    </div>
</div>

@foreach($webhooks as $webhook)
<div class="card-admin mb-3">
    <div class="card-body">
        <form action="{{ route('admin.webhooks.update', $webhook) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row align-items-center">
                <!-- Evento info -->
                <div class="col-lg-3 mb-3 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            @if($webhook->evento === 'contacto')
                                <div class="stat-icon" style="background: rgba(239,68,68,0.1); color: #EF4444; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            @elseif($webhook->evento === 'bolsa')
                                <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: #10B981; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            @elseif($webhook->evento === 'post_creado')
                                <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: #F59E0B; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h6 class="mb-0" style="font-weight: 700; color: #1E293B;">{{ $webhook->nombre }}</h6>
                            <small class="text-muted">Evento: <code>{{ $webhook->evento }}</code></small>
                        </div>
                    </div>
                </div>

                <!-- URL -->
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <label class="form-label">URL del Webhook</label>
                    <input type="url" name="url" class="form-control" value="{{ $webhook->url }}" placeholder="https://n8n.tudominio.com/webhook/...">
                </div>

                <!-- Secret -->
                <div class="col-lg-2 mb-3 mb-lg-0">
                    <label class="form-label">Secret <small class="text-muted">(opcional)</small></label>
                    <input type="text" name="secret" class="form-control" value="{{ $webhook->secret }}" placeholder="mi-secret">
                </div>

                <!-- Toggle + Actions -->
                <div class="col-lg-3">
                    <label class="form-label">Estado</label>
                    <div class="d-flex align-items-center gap-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="activo" value="1" id="activo_{{ $webhook->id }}" {{ $webhook->activo ? 'checked' : '' }} style="width: 42px; height: 22px; cursor: pointer;">
                            <label class="form-check-label" for="activo_{{ $webhook->id }}" style="font-size: 13px; font-weight: 600; cursor: pointer;">
                                {{ $webhook->activo ? 'Activo' : 'Inactivo' }}
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary-admin btn-sm" title="Guardar">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Status row -->
            @if($webhook->ultimo_envio)
            <div class="mt-3 pt-3" style="border-top: 1px solid #E2E8F0;">
                <div class="d-flex align-items-center justify-content-between">
                    <div style="font-size: 12px; color: #64748B;">
                        <i class="fas fa-clock me-1"></i>Último envío: <strong>{{ $webhook->ultimo_envio->format('d/m/Y H:i:s') }}</strong>
                        @if($webhook->ultimo_estado === 'ok')
                            <span class="badge-activo ms-2"><i class="fas fa-check me-1"></i>OK</span>
                        @else
                            <span class="badge-inactivo ms-2"><i class="fas fa-times me-1"></i>Error</span>
                            @if($webhook->ultimo_error)
                                <span class="text-danger ms-2">{{ $webhook->ultimo_error }}</span>
                            @endif
                        @endif
                    </div>
                    <a href="{{ route('admin.webhooks.test', $webhook) }}" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Enviar test a este webhook?')">
                        <i class="fas fa-paper-plane me-1"></i>Test
                    </a>
                </div>
            </div>
            @else
                @if(!empty($webhook->url))
                <div class="mt-3 pt-3" style="border-top: 1px solid #E2E8F0;">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="{{ route('admin.webhooks.test', $webhook) }}" class="btn btn-outline-secondary btn-sm" onclick="return confirm('¿Enviar test a este webhook?')">
                            <i class="fas fa-paper-plane me-1"></i>Enviar Test
                        </a>
                    </div>
                </div>
                @endif
            @endif
        </form>
    </div>
</div>
@endforeach

<div class="card-admin">
    <div class="card-body">
        <h6 class="mb-3" style="font-weight: 700; color: #1E293B;"><i class="fas fa-code me-2"></i>Estructura del Payload</h6>
        <div style="background: #1E293B; border-radius: 10px; padding: 20px; color: #E2E8F0; font-family: 'Courier New', monospace; font-size: 13px; overflow-x: auto;">
<pre style="margin: 0; color: #E2E8F0;">{
  "evento": "contacto",
  "timestamp": "2026-02-18T12:00:00-06:00",
  "data": {
    "nombre": "Juan Pérez",
    "email": "juan@ejemplo.com",
    "telefono": "55 1234 5678",
    "empresa": "Mi Empresa",
    "mensaje": "Quisiera más información..."
  }
}</pre>
        </div>
        <div class="mt-3" style="font-size: 12px; color: #64748B;">
            <p class="mb-1"><strong>Headers enviados:</strong></p>
            <ul class="mb-0">
                <li><code>Content-Type: application/json</code></li>
                <li><code>X-Webhook-Event: contacto|bolsa|post_creado</code></li>
                <li><code>X-Webhook-Signature: hmac-sha256</code> <small>(solo si configuraste un secret)</small></li>
                <li><code>User-Agent: GPOVanguardia-Webhook/1.0</code></li>
            </ul>
        </div>
    </div>
</div>
@endsection
