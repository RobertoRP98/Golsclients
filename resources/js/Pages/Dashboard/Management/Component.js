import { t } from '@/Lang/i18n';
import { hasPermission } from '@/rolePermission.js';

// Obtener ruta que fue modificada a services
const goTo = (route) => `dashboard.management.${route}`
// Obtener traducción del componente
const transl = (lang) => t(`management.${lang}`)
// Determina si un usuario puede hacer algo no en base a los permisos
const can = (permission) => hasPermission(`management.${permission}`)

export {
    can,
    goTo,
    transl
}