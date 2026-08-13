export class GuardQueue {
    constructor() {
        this.guards = [];
    }

    register(guard) {
        this.guards.push({ guard });
    }

    unregister(guardName) {
        this.guards = this.guards.filter(({ guard }) => guard.name !== guardName);
    }

    execute(context) {
        for (const { guard } of this.guards) {
            const result = guard(context);
            if (result) {
                return result;
            }
        }

        return null;
    }
}
