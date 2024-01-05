import { t } from '@/Lang/i18n';
import { hasPermission } from '@/rolePermission.js';

// Obtener ruta que fue modificada a clients
const goTo = (route) => `dashboard.clients.${route}`
// Obtener traducción del componente
const transl = (lang) => t(`contracts.${lang}`)
// Determina si un usuario puede hacer algo no en base a los permisos
const can = (permission) => hasPermission(`clients.${permission}`)

export {
    can,
    goTo,
    transl
}