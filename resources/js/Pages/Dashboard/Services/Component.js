import { t } from '@/Lang/i18n';
import { hasPermission } from '@/rolePermission.js';

// Obtener ruta
const goTo = (route) => `dashboard.services.${route}`
// Obtener traducción del componente
const transl = (lang) => t(`services.${lang}`)
// Determina si un usuario puede hacer algo no en base a los permisos
const can = (permission) => hasPermission(`services.${permission}`)

export {
    can,
    goTo,
    transl
}