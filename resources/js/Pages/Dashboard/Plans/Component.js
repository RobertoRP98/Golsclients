import { t } from '@/Lang/i18n';
import { hasPermission } from '@/rolePermission.js';

// Obtener ruta que fue modificada a services
const goTo = (route) => `dashboard.plans.${route}`
// Obtener traducción del componente
const transl = (lang) => t(`plans.${lang}`)
// Determina si un usuario puede hacer algo no en base a los permisos
const can = (permission) => hasPermission(`plans.${permission}`)

export {
    can,
    goTo,
    transl
}